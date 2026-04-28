<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Configurations | Writer Dashboard</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col md:flex-row writer-app bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'ai-configurations'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-12">
                <section class="space-y-4 border-b border-zinc-900 dark:border-zinc-300 pb-8">
                    <p class="font-mono text-xs uppercase font-black tracking-[0.2em] opacity-80">Automation / Model Keys</p>
                    <h1 class="font-black text-5xl sm:text-6xl lg:text-8xl leading-[0.85] tracking-tighter uppercase">
                        AI<br>Configurations.
                    </h1>
                    <p class="max-w-2xl font-bold uppercase text-sm leading-relaxed opacity-70 mt-4">
                        Kelola model AI aktif kamu dalam satu halaman. Tambah, edit, dan hapus konfigurasi melalui dialog.
                    </p>
                </section>

                @if ($errors->any())
                    <div class="p-4 brutalist-border bg-red-50 dark:bg-red-950 text-red-900 dark:text-red-100 font-mono text-xs uppercase" role="alert">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="space-y-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 border-b border-zinc-900 dark:border-zinc-300 pb-4">
                        <h2 class="font-black text-4xl tracking-tighter uppercase">Daftar Konfigurasi ({{ number_format($configurations->total()) }})</h2>
                        <button
                            type="button"
                            class="border-2 border-zinc-900 dark:border-zinc-300 px-6 py-3 uppercase font-black text-xs tracking-[0.2em] hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors"
                            data-dialog-trigger="ai-config-create-dialog"
                        >
                            + Tambah Konfigurasi
                        </button>
                    </div>

                    @if ($configurations->count() > 0)
                        <div class="space-y-4">
                            @foreach ($configurations as $configuration)
                                @php
                                    $decryptedApiKey = null;
                                    $statusClass = match ($configuration->status) {
                                        'active' => 'bg-green-100 text-green-900 dark:bg-green-900/40 dark:text-green-200',
                                        'in-active' => 'bg-zinc-200 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-200',
                                        'expired' => 'bg-red-100 text-red-900 dark:bg-red-900/40 dark:text-red-200',
                                        default => 'bg-amber-100 text-amber-900 dark:bg-amber-900/40 dark:text-amber-200',
                                    };
                                    try {
                                        $decryptedApiKey = \Illuminate\Support\Facades\Crypt::decryptString($configuration->ai_key);
                                    } catch (\Throwable $exception) {
                                        $decryptedApiKey = null;
                                    }
                                @endphp
                                <article class="brutalist-border p-6 space-y-4">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                        <div class="space-y-1 min-w-0">
                                            <p class="font-mono text-[10px] uppercase opacity-60">Model</p>
                                            <h3 class="font-black text-2xl uppercase tracking-tight truncate">{{ $configuration->ai_models }}</h3>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="px-2 py-1 text-[10px] font-black uppercase {{ $statusClass }}">
                                                {{ $configuration->status }}
                                            </span>
                                            <p class="font-mono text-[10px] uppercase opacity-60">Updated {{ $configuration->updated_at?->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="font-mono text-[10px] uppercase opacity-60 mb-2">Description</p>
                                            <x-ui.hover-card side="top" align="start" :open-delay="120" :close-delay="100" content-class="w-96">
                                                <x-slot:trigger>
                                                    <p class="leading-relaxed cursor-help underline decoration-dotted underline-offset-4">
                                                        {{ \Illuminate\Support\Str::limit($configuration->ai_descripsion, 90) }}
                                                    </p>
                                                </x-slot:trigger>
                                                <x-slot:content>
                                                    <p class="font-mono text-[10px] uppercase opacity-60 mb-2">Full Description</p>
                                                    <p class="leading-relaxed normal-case">{{ $configuration->ai_descripsion }}</p>
                                                </x-slot:content>
                                            </x-ui.hover-card>
                                        </div>
                                        <div>
                                            <p class="font-mono text-[10px] uppercase opacity-60 mb-2">API Key</p>
                                            <div class="relative">
                                                <code
                                                    id="api-key-hash-{{ $configuration->id }}"
                                                    data-secret-visible="false"
                                                    data-secret-value="{{ $decryptedApiKey ?? '' }}"
                                                    data-can-reveal="{{ $decryptedApiKey ? 'true' : 'false' }}"
                                                    class="block text-xs bg-zinc-100 dark:bg-zinc-900 p-3 pr-14 border border-zinc-900 dark:border-zinc-300 break-all"
                                                >
                                                    ****************
                                                </code>
                                                <button
                                                    type="button"
                                                    class="absolute right-0 top-0 h-full w-12 flex items-center justify-center border-l-2 border-zinc-900 dark:border-zinc-300 bg-white dark:bg-zinc-950 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors"
                                                    data-toggle-secret
                                                    data-target="api-key-hash-{{ $configuration->id }}"
                                                    aria-label="Toggle API key hash visibility"
                                                >
                                                    <iconify-icon icon="lucide:eye" class="text-lg" data-eye-on></iconify-icon>
                                                    <iconify-icon icon="lucide:eye-off" class="text-lg hidden" data-eye-off></iconify-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-3 pt-2">
                                        <button
                                            type="button"
                                            class="border-2 border-zinc-900 dark:border-zinc-300 px-4 py-2 uppercase font-black text-[10px] tracking-[0.2em] hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors"
                                            data-dialog-trigger="ai-config-edit-dialog-{{ $configuration->id }}"
                                        >
                                            Edit
                                        </button>
                                        <form method="post" action="{{ route('writer.ai-configurations.destroy', $configuration) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="border-2 border-red-700 text-red-700 dark:border-red-300 dark:text-red-300 px-4 py-2 uppercase font-black text-[10px] tracking-[0.2em] hover:bg-red-700 hover:text-white dark:hover:bg-red-300 dark:hover:text-zinc-950 transition-colors"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <x-ui.pagination :paginator="$configurations" />
                    @else
                        <x-ui.empaty
                            title="Belum ada konfigurasi"
                            message="Tambahkan konfigurasi AI pertama kamu untuk mulai automasi konten."
                        />
                    @endif
                </section>
            </main>

            @include('components.writer.profile-aside')
        </div>
    </div>

    <x-ui.dialog id="ai-config-create-dialog" title="Tambah AI Configuration" description="Isi data model, deskripsi, dan kunci API.">
        <form method="post" action="{{ route('writer.ai-configurations.store') }}" class="space-y-6">
            @csrf
            <div>
                <x-ui.label for="create-ai-models" text="AI Models" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                <x-ui.input id="create-ai-models" name="ai_models" :value="old('ai_models')" required class="brutalist-input w-full dark:bg-transparent" />
            </div>
            <div>
                <x-ui.label for="create-ai-description" text="AI Description" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                <x-ui.textarea id="create-ai-description" name="ai_description" rows="4" required class="brutalist-input w-full dark:bg-transparent">{{ old('ai_description') }}</x-ui.textarea>
            </div>
            <div>
                <x-ui.label for="create-status" text="Status" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                <select id="create-status" name="status" class="brutalist-input h-[54px] w-full appearance-none cursor-pointer dark:bg-transparent" required>
                    <x-ui.option value="active" label="active" :selected="old('status') === 'active'" />
                    <x-ui.option value="in-active" label="in-active" :selected="old('status') === 'in-active'" />
                    <x-ui.option value="draft" label="draft" :selected="old('status', 'draft') === 'draft'" />
                    <x-ui.option value="expired" label="expired" :selected="old('status') === 'expired'" />
                </select>
            </div>
            <div>
                <x-ui.label for="create-ai-key" text="AI Key" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                <div class="relative">
                    <x-ui.input id="create-ai-key" name="ai_key" type="password" :value="old('ai_key')" required class="brutalist-input w-full pr-14 dark:bg-transparent" />
                    <button
                        type="button"
                        class="absolute right-0 top-0 h-full w-12 flex items-center justify-center border-l-2 border-zinc-900 dark:border-zinc-300 bg-white dark:bg-zinc-950 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors"
                        data-toggle-password
                        data-target="create-ai-key"
                        aria-label="Toggle API key visibility"
                    >
                        <iconify-icon icon="lucide:eye" class="text-lg" data-eye-on></iconify-icon>
                        <iconify-icon icon="lucide:eye-off" class="text-lg hidden" data-eye-off></iconify-icon>
                    </button>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 pt-2">
                <x-ui.button type="submit" class="border-2 border-zinc-900 dark:border-zinc-300 bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-6 py-3 uppercase font-black text-xs tracking-[0.2em]">
                    Simpan
                </x-ui.button>
                <button type="button" class="border-2 border-zinc-900 dark:border-zinc-300 px-6 py-3 uppercase font-black text-xs tracking-[0.2em]" data-dialog-close>Batal</button>
            </div>
        </form>
    </x-ui.dialog>

    @foreach ($configurations as $configuration)
        <x-ui.dialog id="ai-config-edit-dialog-{{ $configuration->id }}" title="Edit AI Configuration" description="Perbarui data konfigurasi AI.">
            <form method="post" action="{{ route('writer.ai-configurations.update', $configuration) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-ui.label for="edit-ai-models-{{ $configuration->id }}" text="AI Models" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <x-ui.input id="edit-ai-models-{{ $configuration->id }}" name="ai_models" :value="$configuration->ai_models" required class="brutalist-input w-full dark:bg-transparent" />
                </div>
                <div>
                    <x-ui.label for="edit-ai-description-{{ $configuration->id }}" text="AI Description" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <x-ui.textarea id="edit-ai-description-{{ $configuration->id }}" name="ai_description" rows="4" required class="brutalist-input w-full dark:bg-transparent">{{ old('ai_description', $configuration->ai_descripsion) }}</x-ui.textarea>
                </div>
                <div>
                    <x-ui.label for="edit-status-{{ $configuration->id }}" text="Status" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <select id="edit-status-{{ $configuration->id }}" name="status" class="brutalist-input h-[54px] w-full appearance-none cursor-pointer dark:bg-transparent" required>
                        <x-ui.option value="active" label="active" :selected="old('status', $configuration->status) === 'active'" />
                        <x-ui.option value="in-active" label="in-active" :selected="old('status', $configuration->status) === 'in-active'" />
                        <x-ui.option value="draft" label="draft" :selected="old('status', $configuration->status) === 'draft'" />
                        <x-ui.option value="expired" label="expired" :selected="old('status', $configuration->status) === 'expired'" />
                    </select>
                </div>
                <div>
                    <x-ui.label for="edit-ai-key-{{ $configuration->id }}" text="AI Key" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <div class="relative">
                        <x-ui.input id="edit-ai-key-{{ $configuration->id }}" name="ai_key" type="password" placeholder="Kosongkan jika tidak ingin ganti key" class="brutalist-input w-full pr-14 dark:bg-transparent" />
                        <button
                            type="button"
                            class="absolute right-0 top-0 h-full w-12 flex items-center justify-center border-l-2 border-zinc-900 dark:border-zinc-300 bg-white dark:bg-zinc-950 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors"
                            data-toggle-password
                            data-target="edit-ai-key-{{ $configuration->id }}"
                            aria-label="Toggle API key visibility"
                        >
                            <iconify-icon icon="lucide:eye" class="text-lg" data-eye-on></iconify-icon>
                            <iconify-icon icon="lucide:eye-off" class="text-lg hidden" data-eye-off></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3 pt-2">
                    <x-ui.button type="submit" class="border-2 border-zinc-900 dark:border-zinc-300 bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-6 py-3 uppercase font-black text-xs tracking-[0.2em]">
                        Update
                    </x-ui.button>
                    <button type="button" class="border-2 border-zinc-900 dark:border-zinc-300 px-6 py-3 uppercase font-black text-xs tracking-[0.2em]" data-dialog-close>Batal</button>
                </div>
            </form>
        </x-ui.dialog>
    @endforeach

    <script>
        (function () {
            const root = document.getElementById('root');
            const modeBtn = document.getElementById('writer-mode-toggle');
            if (modeBtn && root) {
                modeBtn.addEventListener('click', function () {
                    document.body.classList.toggle('dark-mode');
                    root.classList.toggle('dark-mode');
                });
            }

            const dialogs = document.querySelectorAll('[data-dialog]');
            const openDialog = function (dialog) {
                dialog.classList.remove('hidden');
                dialog.setAttribute('aria-hidden', 'false');
                document.body.classList.add('overflow-hidden');
            };
            const closeDialog = function (dialog) {
                dialog.classList.add('hidden');
                dialog.setAttribute('aria-hidden', 'true');
                if (![...dialogs].some(function (item) { return !item.classList.contains('hidden'); })) {
                    document.body.classList.remove('overflow-hidden');
                }
            };

            document.querySelectorAll('[data-dialog-trigger]').forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    const dialogId = trigger.getAttribute('data-dialog-trigger');
                    const dialog = document.getElementById(dialogId);
                    if (dialog) {
                        openDialog(dialog);
                    }
                });
            });

            dialogs.forEach(function (dialog) {
                dialog.querySelectorAll('[data-dialog-close]').forEach(function (closer) {
                    closer.addEventListener('click', function () {
                        closeDialog(dialog);
                    });
                });
            });

            document.addEventListener('keydown', function (event) {
                if (event.key !== 'Escape') {
                    return;
                }

                dialogs.forEach(function (dialog) {
                    if (!dialog.classList.contains('hidden')) {
                        closeDialog(dialog);
                    }
                });
            });

            document.querySelectorAll('[data-toggle-password]').forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const targetId = toggle.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    if (!input) {
                        return;
                    }

                    const isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');

                    const eyeOn = toggle.querySelector('[data-eye-on]');
                    const eyeOff = toggle.querySelector('[data-eye-off]');

                    if (eyeOn && eyeOff) {
                        eyeOn.classList.toggle('hidden', isPassword);
                        eyeOff.classList.toggle('hidden', !isPassword);
                    }
                });
            });

            document.querySelectorAll('[data-toggle-secret]').forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const targetId = toggle.getAttribute('data-target');
                    const secretNode = document.getElementById(targetId);
                    if (!secretNode) {
                        return;
                    }

                    const isVisible = secretNode.getAttribute('data-secret-visible') === 'true';
                    const canReveal = secretNode.getAttribute('data-can-reveal') === 'true';
                    const secretValue = secretNode.getAttribute('data-secret-value') || '';
                    secretNode.textContent = isVisible
                        ? '****************'
                        : (canReveal ? secretValue : 'Data lama masih hash dan tidak bisa didecode. Silakan update API key.');
                    secretNode.setAttribute('data-secret-visible', isVisible ? 'false' : 'true');

                    const eyeOn = toggle.querySelector('[data-eye-on]');
                    const eyeOff = toggle.querySelector('[data-eye-off]');
                    if (eyeOn && eyeOff) {
                        eyeOn.classList.toggle('hidden', !isVisible);
                        eyeOff.classList.toggle('hidden', isVisible);
                    }
                });
            });
        })();
    </script>
</body>
</html>
