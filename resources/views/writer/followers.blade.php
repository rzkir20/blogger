<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Network | Writer Community Archive</title>
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
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'followers'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-24 relative">
                <section id="hero" class="space-y-4 border-b border-zinc-900 dark:border-zinc-300 pb-12">
                    <p class="font-mono text-xs uppercase font-black tracking-[0.2em] opacity-80">Community / Network Management</p>
                    <h1 class="font-black text-5xl sm:text-6xl lg:text-9xl leading-[0.85] tracking-tighter uppercase">
                        The<br>Network.
                    </h1>
                    <div class="flex flex-col md:flex-row gap-4 pt-8 w-full">
                        <div class="relative flex-1">
                            <input type="text" placeholder="Search followers by name or region..." class="w-full border-2 border-zinc-900 dark:border-zinc-300 p-4 text-sm font-bold brutalist-input transition-all duration-300 pr-14 dark:bg-transparent">
                            <iconify-icon icon="lucide:search" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl text-zinc-950 dark:text-zinc-50 pointer-events-none"></iconify-icon>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <button type="button" id="filter-btn" class="border-2 border-zinc-900 dark:border-zinc-300 px-8 py-4 uppercase font-bold text-sm hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all flex items-center gap-2 text-zinc-950 dark:text-zinc-50">
                                <iconify-icon icon="lucide:filter"></iconify-icon>
                                Sort By
                            </button>
                            <button type="button" id="export-followers-btn" class="bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-8 py-4 uppercase font-bold text-sm hover:bg-zinc-100 hover:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50 border-2 border-zinc-900 dark:border-zinc-300 transition-all">
                                Export List
                            </button>
                        </div>
                    </div>
                </section>

                <section id="followers-list" class="space-y-12">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 border-b border-zinc-900 dark:border-zinc-300 pb-4">
                        <h2 class="font-black text-4xl tracking-tighter uppercase">Active Subscribers ({{ number_format($networkFollowers->total()) }})</h2>
                        <div class="flex gap-2 mb-1 shrink-0" aria-hidden="true">
                            <span class="w-3 h-3 bg-zinc-950 dark:bg-zinc-100"></span>
                            <span class="w-3 h-3 bg-gray-200 dark:bg-zinc-700"></span>
                            <span class="w-3 h-3 bg-gray-200 dark:bg-zinc-700"></span>
                        </div>
                    </div>

                    @if ($networkFollowers->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-l border-t border-zinc-900 dark:border-zinc-300">
                            @foreach ($networkFollowers as $follower)
                                <div class="p-8 border-r border-b border-zinc-900 dark:border-zinc-300 group hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all duration-300 flex flex-col justify-between h-80">
                                    <div>
                                        <div class="flex justify-between items-start gap-2">
                                            <img
                                                src="{{ $follower['avatar'] }}"
                                                alt="{{ $follower['name'] }}"
                                                class="w-16 h-16 object-cover border-2 border-zinc-900 dark:border-zinc-300 shrink-0 mb-6"
                                            >
                                            <span class="font-mono text-[10px] font-black uppercase tracking-widest opacity-40 group-hover:opacity-60 text-right">{{ $follower['badge'] }}</span>
                                        </div>
                                        <h3 class="text-2xl font-black uppercase leading-tight">{{ $follower['name'] }}</h3>
                                        <p class="font-mono text-xs font-bold uppercase opacity-60 mt-1">{{ $follower['meta'] }}</p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 border-t border-zinc-900 dark:border-zinc-300 group-hover:border-zinc-100 dark:group-hover:border-zinc-600 pt-4 mt-auto transition-colors">
                                        <div class="space-y-1">
                                            <span class="block font-mono text-[9px] font-black uppercase opacity-50">Engagement</span>
                                            <span class="text-lg font-black">{{ $follower['engagement'] }}</span>
                                        </div>
                                        <div class="space-y-1">
                                            <span class="block font-mono text-[9px] font-black uppercase opacity-50">Posts Read</span>
                                            <span class="text-lg font-black">{{ $follower['read'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <x-ui.empaty
                            title="Belum ada followers"
                            message="Belum ada user yang mengikuti akun kamu."
                        />
                    @endif

                    <x-ui.pagination :paginator="$networkFollowers" class="pt-12" />
                </section>

                <footer class="border-t border-zinc-900 dark:border-zinc-300 pt-12 pb-24">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                        <div>
                            <span class="text-2xl font-black tracking-tighter uppercase">Writer.</span>
                            <p class="font-mono text-[10px] font-bold uppercase mt-2 opacity-60 tracking-[0.3em]">© {{ date('Y') }} Archive Editorial Group.</p>
                        </div>
                        <div class="flex flex-wrap gap-8">
                            <a href="#" id="footer-support-link" class="font-mono text-[10px] font-black uppercase underline">Support Channel</a>
                            <a href="#" id="footer-legal-link" class="font-mono text-[10px] font-black uppercase underline">Network Protocol</a>
                        </div>
                    </div>
                </footer>
            </main>

            @include('components.writer.profile-aside')
        </div>
    </div>

    <script>
        (function () {
            const root = document.getElementById('root');
            const btn = document.getElementById('writer-mode-toggle');
            if (btn && root) {
                btn.addEventListener('click', function () {
                    document.body.classList.toggle('dark-mode');
                    root.classList.toggle('dark-mode');
                });
            }
        })();
    </script>
</body>
</html>
