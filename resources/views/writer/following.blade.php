@php
    $followingNetwork = [
        [
            'name' => 'Elena Kostova',
            'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=200&auto=format&fit=crop',
            'badge' => 'ELITE AUTHOR',
            'badge_variant' => 'solid',
            'location' => 'SOFIA, BULGARIA',
            'bio' => 'Investigative journalist specializing in Eastern European political shifts and the resurgence of analog aesthetics in digital spaces.',
            'followers' => '12.4K',
            'posts' => '89',
            'engage' => '18.2%',
        ],
        [
            'name' => 'Kenji Sato',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=200&auto=format&fit=crop',
            'badge' => 'VERIFIED CORE',
            'badge_variant' => 'outline',
            'location' => 'TOKYO, JAPAN',
            'bio' => 'Futurist researcher focusing on urban decay and its influence on contemporary Japanese architecture and interface design.',
            'followers' => '45K',
            'posts' => '312',
            'engage' => '9.5%',
        ],
        [
            'name' => 'Amara Okafor',
            'image' => 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?q=80&w=200&auto=format&fit=crop',
            'badge' => 'RISING STAR',
            'badge_variant' => 'solid',
            'location' => 'LAGOS, NIGERIA',
            'bio' => 'Creative technologist blending traditional Yoruba narratives with blockchain-based publishing protocols and AI storytelling.',
            'followers' => '8.1K',
            'posts' => '45',
            'engage' => '22.1%',
        ],
        [
            'name' => "Liam O'Connor",
            'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop',
            'badge' => 'FOUNDER MEMBER',
            'badge_variant' => 'outline',
            'location' => 'DUBLIN, IRELAND',
            'bio' => 'Essayist covering the philosophical implications of algorithmic bias and the ethics of autonomous content generation systems.',
            'followers' => '15.6K',
            'posts' => '120',
            'engage' => '12.4%',
        ],
        [
            'name' => 'Sofia Rossi',
            'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop',
            'badge' => 'CURATOR',
            'badge_variant' => 'solid',
            'location' => 'MILAN, ITALY',
            'bio' => 'Design critic and editorial director for MODERNO. Explores the impact of Italian rationalism on modern web frameworks.',
            'followers' => '22.8K',
            'posts' => '156',
            'engage' => '15.7%',
        ],
        [
            'name' => 'David Chen',
            'image' => 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?q=80&w=200&auto=format&fit=crop',
            'badge' => 'SENIOR EDITOR',
            'badge_variant' => 'outline',
            'location' => 'VANCOUVER, CANADA',
            'bio' => 'Tech lead and open-source advocate writing about the future of decentralized finance and its role in creator economies.',
            'followers' => '31.2K',
            'posts' => '204',
            'engage' => '10.1%',
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Following Network | Writer Archive Dashboard</title>
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
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'following'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-24 relative">
                <section id="hero" class="space-y-6 border-b-2 border-zinc-900 dark:border-zinc-300 pb-12">
                    <p class="font-mono text-xs uppercase font-black tracking-[0.2em] opacity-60">Subscriptions / Content Protocols</p>
                    <h1 class="font-black text-5xl sm:text-6xl lg:text-9xl leading-[0.85] tracking-tighter uppercase">
                        Following.<br>List.
                    </h1>

                    <div class="flex flex-col xl:flex-row gap-6 pt-10">
                        <div class="relative flex-1">
                            <input type="text" placeholder="Search for followed writers..." class="w-full border-2 border-zinc-900 dark:border-zinc-300 p-5 text-sm font-bold brutalist-input transition-all pr-14 dark:bg-transparent">
                            <iconify-icon icon="lucide:search" class="absolute right-5 top-1/2 -translate-y-1/2 text-xl text-zinc-950 dark:text-zinc-50 pointer-events-none"></iconify-icon>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <button type="button" id="filter-sort-btn" class="border-2 border-zinc-900 dark:border-zinc-300 px-8 py-5 uppercase font-bold text-xs hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all flex items-center gap-2 text-zinc-950 dark:text-zinc-50">
                                <iconify-icon icon="lucide:list-filter"></iconify-icon>
                                Sort: Engagement
                            </button>
                            <button type="button" id="category-btn" class="border-2 border-zinc-900 dark:border-zinc-300 px-8 py-5 uppercase font-bold text-xs hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all flex items-center gap-2 text-zinc-950 dark:text-zinc-50">
                                <iconify-icon icon="lucide:hash"></iconify-icon>
                                All Categories
                            </button>
                        </div>
                    </div>
                </section>

                <section id="following-grid" class="space-y-12">
                    <div class="flex justify-between items-end border-b-2 border-zinc-900 dark:border-zinc-300 pb-4 gap-4">
                        <h2 class="font-black text-3xl sm:text-4xl tracking-tighter uppercase">Active Subscriptions (156)</h2>
                        <div class="hidden sm:flex gap-1 mb-1 shrink-0" aria-hidden="true">
                            <div class="w-2 h-2 bg-zinc-950 dark:bg-zinc-100"></div>
                            <div class="w-2 h-2 bg-zinc-900/30 dark:bg-zinc-500/30"></div>
                            <div class="w-2 h-2 bg-zinc-900/30 dark:bg-zinc-500/30"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-l-2 border-t-2 border-zinc-900 dark:border-zinc-300">
                        @foreach ($followingNetwork as $author)
                            <div class="following-card group p-8 flex flex-col h-[450px] text-zinc-950 dark:text-zinc-50">
                                <div class="flex justify-between items-start mb-8 gap-2">
                                    <div class="w-20 h-20 border-2 border-zinc-900 dark:border-zinc-300 overflow-hidden bg-zinc-950 grayscale group-hover:grayscale-0 transition-all shrink-0">
                                        <img src="{{ $author['image'] }}" alt="{{ $author['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                    </div>
                                    <div class="text-right min-w-0">
                                        @if (($author['badge_variant'] ?? 'solid') === 'solid')
                                            <span class="inline-block font-mono text-[9px] font-black uppercase tracking-widest bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-2 py-1 group-hover:bg-zinc-100 group-hover:text-zinc-950 dark:group-hover:bg-zinc-950 dark:group-hover:text-zinc-50">{{ $author['badge'] }}</span>
                                        @else
                                            <span class="inline-block font-mono text-[9px] font-black uppercase tracking-widest border border-zinc-900 dark:border-zinc-300 px-2 py-1 group-hover:border-zinc-100 dark:group-hover:border-zinc-600">{{ $author['badge'] }}</span>
                                        @endif
                                        <p class="font-mono text-[9px] font-bold uppercase opacity-60 mt-2">{{ $author['location'] }}</p>
                                    </div>
                                </div>

                                <div class="space-y-3 min-h-0">
                                    <h3 class="text-3xl font-black uppercase leading-none tracking-tighter">{{ $author['name'] }}</h3>
                                    <p class="text-xs font-bold leading-relaxed opacity-70 group-hover:opacity-100 line-clamp-3 uppercase">{{ $author['bio'] }}</p>
                                </div>

                                <div class="grid grid-cols-3 gap-4 border-y border-zinc-900 dark:border-zinc-300 group-hover:border-zinc-100 dark:group-hover:border-zinc-600 py-6 my-6 transition-colors">
                                    <div class="space-y-1">
                                        <p class="font-mono text-[8px] font-black opacity-50 uppercase tracking-tighter">Followers</p>
                                        <p class="text-lg font-black tracking-tight">{{ $author['followers'] }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="font-mono text-[8px] font-black opacity-50 uppercase tracking-tighter">Posts</p>
                                        <p class="text-lg font-black tracking-tight">{{ $author['posts'] }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="font-mono text-[8px] font-black opacity-50 uppercase tracking-tighter">Engage</p>
                                        <p class="text-lg font-black tracking-tight">{{ $author['engage'] }}</p>
                                    </div>
                                </div>

                                <div class="mt-auto flex gap-3">
                                    <button type="button" class="flex-1 bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 border-2 border-zinc-900 dark:border-zinc-300 py-3 font-mono text-[10px] font-black uppercase tracking-widest hover:bg-zinc-100 hover:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50 group-hover:bg-zinc-100 group-hover:text-zinc-950 dark:group-hover:bg-zinc-950 dark:group-hover:text-zinc-50 transition-all">View Dossier</button>
                                    <button type="button" class="px-4 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-red-500 hover:text-white hover:border-red-500 group-hover:border-zinc-100 dark:group-hover:border-zinc-600 transition-all flex items-center justify-center text-zinc-950 dark:text-zinc-50" aria-label="Unfollow">
                                        <iconify-icon icon="lucide:user-minus"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-col md:flex-row items-center justify-center gap-6 pt-12 flex-wrap">
                        <div class="flex flex-wrap gap-2 justify-center">
                            <button type="button" class="w-12 h-12 border-2 border-zinc-900 dark:border-zinc-300 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-black text-zinc-950 dark:text-zinc-50">01</button>
                            <button type="button" class="w-12 h-12 border border-zinc-900 dark:border-zinc-300 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-bold text-zinc-950 dark:text-zinc-50">02</button>
                            <button type="button" class="w-12 h-12 border border-zinc-900 dark:border-zinc-300 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-bold text-zinc-950 dark:text-zinc-50">03</button>
                            <span class="flex items-center px-2 font-black tracking-widest">…</span>
                            <button type="button" class="w-12 h-12 border border-zinc-900 dark:border-zinc-300 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-bold text-zinc-950 dark:text-zinc-50">26</button>
                        </div>
                        <button type="button" class="h-12 border-2 border-zinc-900 dark:border-zinc-300 px-10 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-black uppercase tracking-[0.2em] text-xs text-zinc-950 dark:text-zinc-50">Next Batch</button>
                    </div>
                </section>

                <footer class="border-t-2 border-zinc-900 dark:border-zinc-300 pt-12 pb-20">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                        <div>
                            <span class="text-2xl font-black tracking-tighter uppercase">Writer.net</span>
                            <p class="font-mono text-[10px] font-black uppercase mt-2 opacity-50 tracking-[0.3em]">© {{ date('Y') }} Archive Editorial Group. User_subscription_file.</p>
                        </div>
                        <div class="flex flex-wrap gap-10">
                            <a href="#" id="footer-support-link" class="font-mono text-[10px] font-black uppercase underline">Network Support</a>
                            <a href="#" id="footer-legal-link" class="font-mono text-[10px] font-black uppercase underline">Encryption Protocol</a>
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
