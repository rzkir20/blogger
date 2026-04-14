<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer Dashboard | Profile Integration — ARCHIVE</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="writer-app min-h-screen flex flex-col md:flex-row bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'overview'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-24 scroll-mt-0">

                <section id="hero" class="space-y-4 border-b border-zinc-900 dark:border-zinc-300 pb-12 scroll-mt-4">
                    <p class="font-mono text-xs uppercase font-bold tracking-widest opacity-70">Dashboard / Statistics</p>
                    <h1 class="font-black text-5xl sm:text-6xl lg:text-8xl leading-[0.85] tracking-tighter uppercase">
                        Author<br>Metrics.
                    </h1>
                    <div class="flex flex-wrap gap-4 pt-6">
                        <button type="button" id="new-post-btn-main" class="bg-zinc-950 text-zinc-50 px-8 py-3 uppercase font-bold text-sm hover:bg-zinc-100 hover:text-zinc-950 border-2 border-zinc-900 dark:border-zinc-300 transition-all dark:bg-zinc-100 dark:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50">
                            New Post +
                        </button>
                        <button type="button" id="export-btn" class="border-2 border-zinc-900 dark:border-zinc-300 px-8 py-3 uppercase font-bold text-sm hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all">
                            Export Data
                        </button>
                    </div>
                </section>

                <section id="overview" class="scroll-mt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 border-l border-t border-zinc-900 dark:border-zinc-300">
                        <div class="p-8 md:p-10 border-r border-b border-zinc-900 dark:border-zinc-300 flex flex-col justify-between min-h-56 md:min-h-64 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors group">
                            <span class="uppercase text-sm font-bold">Total Posts</span>
                            <div class="space-y-2">
                                <span class="text-6xl md:text-7xl font-black">124</span>
                                <p class="text-xs group-hover:text-zinc-50/60 text-zinc-950/60 dark:text-zinc-400 dark:group-hover:text-zinc-950/60 font-bold uppercase tracking-widest">+12 this month</p>
                            </div>
                        </div>
                        <div class="p-8 md:p-10 border-r border-b border-zinc-900 dark:border-zinc-300 flex flex-col justify-between min-h-56 md:min-h-64 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors group">
                            <span class="uppercase text-sm font-bold">Total Followers</span>
                            <div class="space-y-2">
                                <span class="text-6xl md:text-7xl font-black">8.2K</span>
                                <p class="text-xs group-hover:text-zinc-50/60 text-zinc-950/60 dark:text-zinc-400 dark:group-hover:text-zinc-950/60 font-bold uppercase tracking-widest">Top 2% of Authors</p>
                            </div>
                        </div>
                        <div class="p-8 md:p-10 border-r border-b border-zinc-900 dark:border-zinc-300 flex flex-col justify-between min-h-56 md:min-h-64 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors group">
                            <span class="uppercase text-sm font-bold">Engagement</span>
                            <div class="space-y-2">
                                <span class="text-6xl md:text-7xl font-black">14.2%</span>
                                <p class="text-xs group-hover:text-zinc-50/60 text-zinc-950/60 dark:text-zinc-400 dark:group-hover:text-zinc-950/60 font-bold uppercase tracking-widest">Steady Growth</p>
                            </div>
                        </div>
                        <div class="p-8 md:p-10 border-r border-b border-zinc-900 dark:border-zinc-300 flex flex-col justify-between min-h-56 md:min-h-64 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors group">
                            <span class="uppercase text-sm font-bold">Views</span>
                            <div class="space-y-2">
                                <span class="text-6xl md:text-7xl font-black">240K</span>
                                <p class="text-xs group-hover:text-zinc-50/60 text-zinc-950/60 dark:text-zinc-400 dark:group-hover:text-zinc-950/60 font-bold uppercase tracking-widest">Global Reach</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="posts" class="space-y-8 scroll-mt-4">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 border-b border-zinc-900 dark:border-zinc-300 pb-4">
                        <h2 class="font-black text-4xl md:text-5xl tracking-tighter uppercase">Recent Posts</h2>
                        <a href="{{ route('writer.posts') }}" id="view-all-posts-link" class="font-mono uppercase text-xs font-bold underline mb-1 tracking-widest shrink-0">View All Archives</a>
                    </div>
                    <div class="border-t border-zinc-900 dark:border-zinc-300">
                        <div class="group flex flex-col xl:flex-row items-start xl:items-center justify-between py-8 border-b border-zinc-900 dark:border-zinc-300 px-4 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 cursor-pointer transition-colors">
                            <div class="flex-1 min-w-0">
                                <span class="font-mono text-[10px] font-bold uppercase block mb-1 opacity-60">Sept 24, 2024</span>
                                <h3 class="text-xl md:text-2xl font-black uppercase">Raw Truths: The Death of Modern Design Systems</h3>
                            </div>
                            <div class="flex items-center gap-8 md:gap-12 mt-4 xl:mt-0 shrink-0">
                                <div class="text-right">
                                    <span class="block font-mono text-[10px] uppercase font-bold opacity-60">Views</span>
                                    <span class="text-lg font-black">42,102</span>
                                </div>
                                <div class="text-right">
                                    <span class="block font-mono text-[10px] uppercase font-bold opacity-60">Status</span>
                                    <span class="text-lg font-black">Published</span>
                                </div>
                                <iconify-icon icon="lucide:arrow-up-right" class="text-2xl opacity-0 group-hover:opacity-100 transition-opacity hidden xl:block"></iconify-icon>
                            </div>
                        </div>
                        <div class="group flex flex-col xl:flex-row items-start xl:items-center justify-between py-8 border-b border-zinc-900 dark:border-zinc-300 px-4 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 cursor-pointer transition-colors">
                            <div class="flex-1 min-w-0">
                                <span class="font-mono text-[10px] font-bold uppercase block mb-1 opacity-60">Sept 18, 2024</span>
                                <h3 class="text-xl md:text-2xl font-black uppercase">Minimalism as a Form of Rebellion</h3>
                            </div>
                            <div class="flex items-center gap-8 md:gap-12 mt-4 xl:mt-0 shrink-0">
                                <div class="text-right">
                                    <span class="block font-mono text-[10px] uppercase font-bold opacity-60">Views</span>
                                    <span class="text-lg font-black">18,449</span>
                                </div>
                                <div class="text-right">
                                    <span class="block font-mono text-[10px] uppercase font-bold opacity-60">Status</span>
                                    <span class="text-lg font-black">Published</span>
                                </div>
                                <iconify-icon icon="lucide:arrow-up-right" class="text-2xl opacity-0 group-hover:opacity-100 transition-opacity hidden xl:block"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="followers" class="space-y-8 scroll-mt-4">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 border-b border-zinc-900 dark:border-zinc-300 pb-4">
                        <h2 class="font-black text-4xl md:text-5xl tracking-tighter uppercase">Followers</h2>
                        <a href="{{ route('writer.followers') }}" class="font-mono uppercase text-xs font-bold underline mb-1 tracking-widest shrink-0">View Network</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-6 border-2 border-zinc-900 dark:border-zinc-300 flex items-center gap-4 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors">
                            <div class="w-14 h-14 bg-zinc-950 dark:bg-zinc-100 flex items-center justify-center text-zinc-50 dark:text-zinc-950 shrink-0">
                                <iconify-icon icon="lucide:user" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-lg font-black uppercase">Alex Rivera</h4>
                                <p class="font-mono text-[10px] font-bold uppercase opacity-60">Joined Aug 2024</p>
                            </div>
                        </div>
                        <div class="p-6 border-2 border-zinc-900 dark:border-zinc-300 flex items-center gap-4 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors">
                            <div class="w-14 h-14 bg-zinc-950 dark:bg-zinc-100 flex items-center justify-center text-zinc-50 dark:text-zinc-950 shrink-0">
                                <iconify-icon icon="lucide:user" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-lg font-black uppercase">Sarah Chen</h4>
                                <p class="font-mono text-[10px] font-bold uppercase opacity-60">Joined July 2024</p>
                            </div>
                        </div>
                    </div>
                </section>

                <footer class="border-t border-zinc-900 dark:border-zinc-300 pt-12 pb-16">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                        <div>
                            <span class="text-2xl font-black tracking-tighter uppercase">Writer.</span>
                            <p class="font-mono text-[10px] font-bold uppercase mt-2 opacity-60">© {{ date('Y') }} Archive Editorial Group.</p>
                        </div>
                        <div class="flex gap-8">
                            <a href="#" id="footer-support-link" class="font-mono text-[10px] font-black uppercase underline">Support</a>
                            <a href="#" id="footer-legal-link" class="font-mono text-[10px] font-black uppercase underline">Legal</a>
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
