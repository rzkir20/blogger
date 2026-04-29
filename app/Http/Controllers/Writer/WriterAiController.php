<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\AiConfiguration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WriterAiController extends Controller
{
    public function proxyImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
        ]);

        $url = (string) $validated['url'];
        $host = (string) parse_url($url, PHP_URL_HOST);
        if (Str::lower($host) !== 'images.pexels.com') {
            return response()->json([
                'error' => 'Host gambar tidak diizinkan.',
            ], 422);
        }

        try {
            $response = Http::timeout(30)->get($url);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Gagal mengambil gambar thumbnail dari URL.',
                'details' => $e->getMessage(),
            ], 502);
        }

        if (! $response->ok()) {
            return response()->json([
                'error' => 'Gagal mengambil gambar thumbnail dari URL.',
                'details' => 'HTTP '.$response->status(),
            ], 422);
        }

        $contentType = (string) $response->header('Content-Type', 'image/jpeg');
        if (! str_starts_with($contentType, 'image/')) {
            return response()->json([
                'error' => 'URL thumbnail bukan file gambar.',
            ], 422);
        }

        return response()->json([
            'content_type' => $contentType,
            'data_base64' => base64_encode($response->body()),
        ]);
    }

    public function activeConfigurations(Request $request): JsonResponse
    {
        $configurations = AiConfiguration::query()
            ->where('user_id', $request->user()->id)
            ->where('status', 'active')
            ->latest()
            ->get(['id', 'ai_models', 'status']);

        // Fallback: kalau tidak ada yang active, tampilkan draft untuk tetap bisa dicoba.
        if ($configurations->isEmpty()) {
            $configurations = AiConfiguration::query()
                ->where('user_id', $request->user()->id)
                ->latest()
                ->get(['id', 'ai_models', 'status']);
        }

        return response()->json([
            'configurations' => $configurations,
        ]);
    }

    public function generate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'configuration_id' => ['required', 'integer', 'exists:ai_configurations,id'],
            'prompt' => ['required', 'string', 'min:1', 'max:4000'],
        ]);

        /** @var AiConfiguration $configuration */
        $configuration = AiConfiguration::query()
            ->where('user_id', $request->user()->id)
            ->whereKey($validated['configuration_id'])
            ->firstOrFail();

        try {
            $aiKey = Crypt::decryptString((string) $configuration->ai_key);
        } catch (\Throwable) {
            // Jika sudah terenkripsi/hasil decrypt gagal, kirim pesan yang jelas.
            return response()->json([
                'error' => 'AI key konfigurasi ini tidak bisa didekripsi. Silakan edit ulang konfigurasi AI.',
            ], 422);
        }

        $modelRaw = trim((string) $configuration->ai_models);

        // Tangani kemungkinan data tersimpan sebagai JSON array / CSV.
        if (str_starts_with($modelRaw, '[') || str_starts_with($modelRaw, '{')) {
            try {
                $decoded = json_decode($modelRaw, true);
                if (is_array($decoded)) {
                    $modelRaw = array_values(array_filter(array_map(static function ($v) {
                        return is_string($v) && trim($v) !== '' ? trim($v) : null;
                    }, $decoded)))[0] ?? $modelRaw;
                }
            } catch (\Throwable) {
                // fallback ke modelRaw asli
            }
        }

        if (str_contains($modelRaw, ',')) {
            $parts = array_map('trim', explode(',', $modelRaw));
            $modelRaw = array_values(array_filter($parts, static fn ($p) => $p !== ''))[0] ?? $modelRaw;
        }

        $model = trim($modelRaw, "\"' ");
        if ($model === '') {
            return response()->json([
                'error' => 'Model AI konfigurasi ini tidak valid.',
            ], 422);
        }

        $systemPrompt = 'Kamu adalah asisten penulis untuk dashboard writer. '
            .'Buat draft artikel berbahasa Indonesia berdasarkan instruction pengguna. '
            .'Jawab dalam JSON valid (tanpa markdown dan tanpa code block) dengan format: '
            .'{ "title": string, "category": string, "description": string, "thumbnail_image": string, "content_image": string, "content": string, "tags": string[] }. '
            .'Gunakan category yang singkat dan relevan. '
            .'tags harus berupa array string berisi 3 sampai 6 tag singkat yang relevan. '
            .'Semua field selain tags harus string. '
            .'thumbnail_image dan content_image harus berupa URL gambar langsung dari Pexels (domain images.pexels.com) yang relevan dengan topik artikel. '
            .'Jangan gunakan URL contoh statis atau URL yang sama berulang antar request. '
            .'thumbnail_image dan content_image wajib berbeda URL. '
            .'content harus berupa HTML yang cocok untuk Quill editor dengan struktur heading dan paragraf saja. '
            .'Gunakan hanya tag <h1>, <h2>, <h3>, dan <p> untuk konten utama. '
            .'Gunakan <p> sebagai format normal/default paragraph. '
            .'Untuk paragraf baru, pisahkan konten dengan blok <p> terpisah; jangan membuat semua teks dalam satu paragraf panjang. '
            .'Jangan bungkus jawaban dalam markdown code fence.';

        $payload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $validated['prompt']],
            ],
            'temperature' => 0.4,
            'max_tokens' => 2200,
        ];

        // Aktifkan reasoning bila model yang dipilih adalah reasoning-enabled variant.
        if (str_contains(strtolower($model), 'reasoning')) {
            $payload['reasoning'] = ['enabled' => true];
        }

        try {
            $openRouterRes = Http::connectTimeout(20)
                ->timeout(90)
                ->withHeaders([
                    'Authorization' => 'Bearer '.$aiKey,
                    'Content-Type' => 'application/json',
                    'HTTP-Referer' => (string) $request->headers->get('referer', $request->getSchemeAndHttpHost()),
                    'X-Title' => (string) config('app.name', 'Writer'),
                ])
                ->post('https://openrouter.ai/api/v1/chat/completions', $payload);
        } catch (\Throwable $e) {
            Log::error('OpenRouter request exception.', [
                'model' => $model,
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'OpenRouter tidak bisa dijangkau (timeout/koneksi).',
                'details' => [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                ],
            ], 502);
        }

        if (! $openRouterRes->ok()) {
            $details = $openRouterRes->json('error') ?: $openRouterRes->body();
            $upstreamStatus = $openRouterRes->status();

            $errorMessage = match ($upstreamStatus) {
                401, 403 => 'OpenRouter menolak API key konfigurasi ini. Silakan cek atau ganti API key.',
                422 => 'Request ke OpenRouter tidak valid untuk model yang dipilih.',
                429 => 'Batas request OpenRouter tercapai. Coba lagi sebentar lagi.',
                default => 'OpenRouter gagal memproses request.',
            };

            Log::error('OpenRouter gagal memproses request.', [
                'model' => $model,
                'status' => $upstreamStatus,
                // Jangan log API key.
                'details' => is_string($details) ? mb_substr($details, 0, 2000) : $details,
            ]);

            return response()->json([
                'error' => $errorMessage,
                'details' => $details,
            ], $upstreamStatus >= 400 && $upstreamStatus < 600 ? $upstreamStatus : 502);
        }

        $content = (string) data_get($openRouterRes->json(), 'choices.0.message.content', '');

        return response()->json([
            'output' => $content,
        ]);
    }
}

