<!DOCTYPE html>
@php
    $articleDate = $post->created_at?->format('m.d.Y') ?? now()->format('m.d.Y');
    $wordCount = str_word_count(strip_tags((string) $post->content));
    $readTime = max(1, (int) ceil($wordCount / 200));
@endphp
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | {{ $pageTitle }} – Article Detail</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen">
        @include('components.header')

        <main>
            <section class="grid grid-cols-1 lg:grid-cols-12 brutalist-border-b">
                <div class="lg:col-span-8 p-8 lg:p-16 brutalist-border-r">
                    <div class="flex flex-wrap items-center gap-6 mb-12 font-mono text-xs uppercase tracking-widest">
                        <span class="bg-black text-white px-3 py-1">Ref: {{ $articleRef }}</span>
                        <span>/</span>
                        <span>Issue 004</span>
                        <span>/</span>
                        <span class="accent-red font-bold">{{ $post->category }}</span>
                        <span>/</span>
                        <span>{{ $articleDate }}</span>
                        <span class="opacity-60">/</span>
                        <span class="font-mono text-[10px] normal-case opacity-70">{{ $slug }}</span>
                    </div>

                    <h1 class="font-black text-6xl md:text-8xl lg:text-9xl leading-[0.85] tracking-tighter mb-16 uppercase">
                        {{ $headlineLine1 }} <br> {{ $headlineLine2 }}.
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-end mb-16">
                        <p class="text-2xl font-bold uppercase leading-none tracking-tight">
                            {{ $post->description }}
                        </p>
                        <div class="font-mono text-[10px] uppercase space-y-2">
                            <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Author</span><span class="font-bold">{{ $post->author }}</span></div>
                            <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Words</span><span class="font-bold">{{ number_format($wordCount) }}</span></div>
                            <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Read Time</span><span class="font-bold">{{ $readTime }} Min</span></div>
                        </div>
                    </div>

                    <div class="brutalist-border-4 mb-16 grayscale group overflow-hidden">
                        <img src="{{ $post->thumbnail ? asset('storage/'.$post->thumbnail) : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=1440' }}" class="w-full h-auto transition-transform duration-700 group-hover:scale-105" alt="{{ $post->title }}">
                    </div>

                    <div class="max-w-3xl mx-auto space-y-8 text-xl leading-relaxed prose dark:prose-invert">
                        {!! $post->content !!}
                    </div>
                </div>

                <aside class="lg:col-span-4">
                    <div class="sticky top-20">
                        <div class="p-8 brutalist-border-b font-mono text-xs uppercase tracking-widest bg-black text-white">
                            Metric_Data_Stream
                        </div>
                        <div class="p-8 brutalist-border-b space-y-8">
                            <div>
                                <h4 class="font-black text-xl uppercase mb-4 tracking-tighter">Engagement</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="border border-black dark:border-white p-3">
                                        <p class="font-mono text-[10px] uppercase opacity-60">Views</p>
                                        <p class="font-black text-xl uppercase">{{ number_format($viewCount) }}</p>
                                    </div>
                                    <div class="border border-black dark:border-white p-3">
                                        <p class="font-mono text-[10px] uppercase opacity-60">Likes</p>
                                        <p class="font-black text-xl uppercase">{{ number_format($likeCount) }}</p>
                                    </div>
                                    <div class="border border-black dark:border-white p-3 col-span-2">
                                        <p class="font-mono text-[10px] uppercase opacity-60">Comments</p>
                                        <p class="font-black text-xl uppercase">{{ number_format($commentCount) }}</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    @auth
                                        <form method="post" action="{{ route('articles.like', $slug) }}">
                                            @csrf
                                            <button type="submit" class="w-full p-3 text-center font-mono text-[10px] uppercase border-2 border-black dark:border-white {{ $isLikedByUser ? 'bg-black text-white dark:bg-white dark:text-black' : 'hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black' }}">
                                                {{ $isLikedByUser ? 'Unlike' : 'Like' }}
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="block w-full p-3 text-center font-mono text-[10px] uppercase border-2 border-black dark:border-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black">Login to Like</a>
                                    @endauth
                                </div>
                            </div>
                            <div>
                                <h4 class="font-black text-xl uppercase mb-4 tracking-tighter">Keywords</h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($post->tags ?? [] as $tag)
                                        <span class="border border-black dark:border-white px-3 py-1 text-[10px] font-mono uppercase">#{{ $tag }}</span>
                                    @empty
                                        <span class="border border-black dark:border-white px-3 py-1 text-[10px] font-mono uppercase">#No_Tags</span>
                                    @endforelse
                                </div>
                            </div>
                            <div>
                                <h4 class="font-black text-xl uppercase mb-4 tracking-tighter">Share_Protocol</h4>
                                <div class="grid grid-cols-2 gap-0 border-2 border-black dark:border-white">
                                    <a href="#" class="p-4 text-center font-mono text-[10px] uppercase brutalist-border-r brutalist-border-b hover-red">X_Network</a>
                                    <button type="button" id="share-copy" class="p-4 text-center font-mono text-[10px] uppercase brutalist-border-b hover-red w-full bg-transparent cursor-pointer">Copy_Link</button>
                                    <a href="#" class="p-4 text-center font-mono text-[10px] uppercase brutalist-border-r hover-red">Email_Enc</a>
                                    <a href="#" class="p-4 text-center font-mono text-[10px] uppercase hover-red">Print_Doc</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 brutalist-border-b bg-red-600 text-white space-y-6">
                            <h4 class="font-black text-2xl uppercase tracking-tighter leading-none">Support This Author</h4>
                            <div class="flex items-center gap-4">
                                <img src="{{ $authorProfile['avatar'] }}" alt="{{ $authorProfile['name'] }}" class="w-16 h-16 object-cover border-2 border-white">
                                <div>
                                    <p class="font-black text-lg uppercase leading-none">{{ $authorProfile['name'] }}</p>
                                    <p class="font-mono text-[10px] uppercase mt-2">Followers: {{ number_format($authorProfile['followers']) }}</p>
                                </div>
                            </div>
                            <p class="text-xs font-mono uppercase">Back this writer and keep independent transmissions alive.</p>
                            @auth
                                <form method="post" action="{{ route('articles.follow', $slug) }}">
                                    @csrf
                                    <button type="submit" class="block w-full py-4 text-center font-black uppercase text-sm transition-colors {{ $isFollowingAuthor ? 'bg-black text-white cursor-default' : 'bg-white text-black hover:bg-black hover:text-white' }}" @disabled($isFollowingAuthor)>
                                        {{ $isFollowingAuthor ? 'Following' : 'Follow' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block w-full py-4 text-center bg-white text-black font-black uppercase text-sm hover:bg-black hover:text-white transition-colors">Login to Follow</a>
                            @endauth
                        </div>
                        <div class="p-8">
                            <h4 class="font-black text-xl uppercase mb-6 tracking-tighter">Next_Transmission</h4>
                            <a href="{{ url('/articles/analog-fetishism-in-the-age-of-silicon') }}" class="group cursor-pointer block">
                                <div class="aspect-video bg-black mb-4 overflow-hidden brutalist-border grayscale group-hover:grayscale-0">
                                    <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover" alt="Related">
                                </div>
                                <h5 class="font-bold text-lg uppercase leading-none mb-2 group-hover:text-red-600">Analog fetishism in the age of silicon.</h5>
                                <div class="font-mono text-[10px] uppercase">Author: E. Thorne</div>
                            </a>
                        </div>
                    </div>
                </aside>
            </section>

            <section class="p-8 lg:p-16 brutalist-border-b space-y-8">
                <h2 class="font-black text-4xl lg:text-6xl uppercase tracking-tighter">Comments</h2>

                @auth
                    <form method="post" action="{{ route('articles.comments.store', $slug) }}" class="space-y-4 brutalist-border p-6">
                        @csrf
                        <x-ui.label for="article-comment" text="Write Your Comment" />
                        <x-ui.textarea id="article-comment" name="comment" rows="4" class="w-full brutalist-input dark:bg-transparent">{{ old('comment') }}</x-ui.textarea>
                        @error('comment')
                            <p class="font-mono text-[10px] uppercase text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <x-ui.button type="submit" class="brutalist-btn-black">Post Comment</x-ui.button>
                    </form>
                @else
                    <div class="brutalist-border p-6">
                        <p class="font-mono text-xs uppercase opacity-70">Login untuk menambahkan komentar.</p>
                        <a href="{{ route('login') }}" class="inline-block mt-4 brutalist-btn-black">Login</a>
                    </div>
                @endauth

                <div class="space-y-4">
                    @forelse ($comments as $commentItem)
                        <article class="brutalist-border p-6 space-y-3">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <img
                                        src="{{ $commentItem->user?->avatar_path ? asset('storage/'.$commentItem->user->avatar_path) : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=120' }}"
                                        alt="{{ $commentItem->user?->name ?? 'Anonymous' }}"
                                        class="w-10 h-10 object-cover border-2 border-black dark:border-white shrink-0"
                                    >
                                    <div class="min-w-0">
                                        <p class="font-black uppercase truncate">{{ $commentItem->user?->name ?? 'Anonymous' }}</p>
                                        <p class="font-mono text-[10px] uppercase opacity-60">
                                            {{ $commentItem->user?->role ? str_replace('_', ' ', strtoupper($commentItem->user->role)) : 'guest' }}
                                        </p>
                                    </div>
                                </div>
                                <p class="font-mono text-[10px] uppercase opacity-60">{{ $commentItem->created_at?->format('d M Y H:i') }}</p>
                            </div>
                            <p class="leading-relaxed">{{ $commentItem->comment }}</p>
                        </article>
                    @empty
                        <x-ui.empaty
                            title="No Comments Yet"
                            message="Belum ada komentar untuk artikel ini."
                        />
                    @endforelse
                </div>
            </section>

            <section class="p-8 lg:p-16 brutalist-border-b">
                <h2 class="font-black text-4xl lg:text-6xl uppercase tracking-tighter mb-12">More From {{ $post->author }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 border-t-2 border-l-2 border-black dark:border-white">
                    @forelse ($moreFromAuthor as $relatedPost)
                        <a href="{{ $relatedPost['href'] }}" class="p-6 border-r-2 border-b-2 border-black dark:border-white group cursor-pointer hover:bg-black hover:text-white transition-colors block">
                            <span class="font-mono text-[10px] block mb-4">REF: {{ $relatedPost['ref'] }}</span>
                            <h3 class="font-black text-2xl uppercase leading-none mb-4">{{ $relatedPost['title'] }}</h3>
                            <p class="text-xs mb-6 opacity-60 uppercase">{{ $relatedPost['description'] }}</p>
                            <span class="font-mono text-[10px] underline">Open File</span>
                        </a>
                    @empty
                        <div class="border-r-2 border-b-2 border-black dark:border-white p-4 md:col-span-2 lg:col-span-4">
                            <x-ui.empaty
                                title="No More Posts"
                                message="This author has no other published posts yet."
                            />
                        </div>
                    @endforelse
                </div>
            </section>
        </main>

        @include('components.footer')
    </div>

    <script>
        (function () {
            var btn = document.getElementById('share-copy');
            if (!btn) return;
            btn.addEventListener('click', function () {
                var url = window.location.href;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(function () {
                        var t = btn.textContent;
                        btn.textContent = 'COPIED';
                        setTimeout(function () { btn.textContent = t; }, 2000);
                    });
                }
            });
        })();
    </script>
</body>
</html>
