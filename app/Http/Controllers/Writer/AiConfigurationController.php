<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\AiConfiguration;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class AiConfigurationController extends Controller
{
    public function index(Request $request): View
    {
        $configurations = AiConfiguration::query()
            ->whereBelongsTo($request->user())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('writer.ai-configurations', [
            'activeNav' => 'ai-configurations',
            'configurations' => $configurations,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_models' => ['required', 'string', 'max:120'],
            'ai_description' => ['required', 'string', 'max:3000'],
            'ai_key' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:active,in-active,draft,expired'],
        ]);

        $validated['ai_descripsion'] = $validated['ai_description'];
        unset($validated['ai_description']);
        $validated['ai_key'] = Crypt::encryptString($validated['ai_key']);
        $validated['user_id'] = $request->user()->id;

        AiConfiguration::query()->create($validated);

        ToastMagic::success('AI configuration ditambahkan', 'Konfigurasi baru berhasil disimpan.');

        return redirect()->route('writer.ai-configurations');
    }

    public function update(Request $request, AiConfiguration $aiConfiguration): RedirectResponse
    {
        abort_unless($aiConfiguration->user_id === $request->user()->id, 403);

        $validated = $request->validate([
            'ai_models' => ['required', 'string', 'max:120'],
            'ai_description' => ['required', 'string', 'max:3000'],
            'ai_key' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,in-active,draft,expired'],
        ]);

        $validated['ai_descripsion'] = $validated['ai_description'];
        unset($validated['ai_description']);

        if (! empty($validated['ai_key'])) {
            $validated['ai_key'] = Crypt::encryptString($validated['ai_key']);
        } else {
            unset($validated['ai_key']);
        }

        $aiConfiguration->update($validated);

        ToastMagic::success('AI configuration diupdate', 'Perubahan konfigurasi berhasil disimpan.');

        return redirect()->route('writer.ai-configurations');
    }

    public function destroy(Request $request, AiConfiguration $aiConfiguration): RedirectResponse
    {
        abort_unless($aiConfiguration->user_id === $request->user()->id, 403);

        AiConfiguration::query()
            ->whereKey($aiConfiguration->id)
            ->delete();

        ToastMagic::info('AI configuration dihapus', 'Konfigurasi telah dihapus dari daftar.');

        return redirect()->route('writer.ai-configurations');
    }
}
