<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | {{ $writer->name }} – Author Detail</title>
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
                    <span class="font-mono text-xs uppercase tracking-widest mb-4 block">Author Registry / Node Detail</span>
                    <h1 class="font-black text-6xl md:text-8xl lg:text-9xl uppercase tracking-tighter leading-[0.85] mb-8">
                        {{ $writer->name }}
                    </h1>
                    <p class="font-mono text-xs uppercase tracking-widest opacity-60 mb-8">
                        Region: {{ $writer->region ?: 'N/A' }}
                    </p>
                    <div class="flex flex-wrap gap-3 mb-8">
                        @if ($writer->instagram_url)
                            <a href="{{ $writer->instagram_url }}" target="_blank" rel="noopener noreferrer" class="brutalist-btn inline-flex items-center gap-2">
                                <iconify-icon icon="lucide:instagram" class="text-base"></iconify-icon>
                                Instagram
                            </a>
                        @endif
                        @if ($writer->website_url)
                            <a href="{{ $writer->website_url }}" target="_blank" rel="noopener noreferrer" class="brutalist-btn inline-flex items-center gap-2">
                                <iconify-icon icon="lucide:globe" class="text-base"></iconify-icon>
                                Website
                            </a>
                        @endif
                        @if ($writer->twitter_url)
                            <a href="{{ $writer->twitter_url }}" target="_blank" rel="noopener noreferrer" class="brutalist-btn inline-flex items-center gap-2">
                                <iconify-icon icon="lucide:twitter" class="text-base"></iconify-icon>
                                Twitter / X
                            </a>
                        @endif
                    </div>
                    <p class="text-xl font-bold uppercase leading-tight max-w-3xl">
                        {{ $writer->bio ?: 'This writer has not added a bio yet.' }}
                    </p>
                </div>
                <div class="lg:col-span-4 p-8 lg:p-16 space-y-6">
                    <div class="aspect-square brutalist-border grayscale overflow-hidden">
                        <img src="{{ $writer->avatar_path ? asset('storage/'.$writer->avatar_path) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.urlencode($writer->name) }}" class="w-full h-full object-cover bg-slate-100" alt="{{ $writer->name }}">
                    </div>
                    <div class="font-mono text-[10px] uppercase space-y-2">
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Role</span><span class="font-bold">{{ str_replace('_', ' ', strtoupper((string) $writer->role)) }}</span></div>
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Member Since</span><span class="font-bold">{{ strtoupper($writer->created_at?->format('M Y') ?? 'N/A') }}</span></div>
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Followers</span><span class="font-bold">{{ number_format($followersCount) }}</span></div>
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Following</span><span class="font-bold">{{ number_format($followingCount) }}</span></div>
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Total Posts</span><span class="font-bold">{{ number_format($totalPosts) }}</span></div>
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Total Views</span><span class="font-bold">{{ number_format($totalViews) }}</span></div>
                        <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Total Likes</span><span class="font-bold">{{ number_format($totalLikes) }}</span></div>
                    </div>
                    @auth
                        <form method="post" action="{{ route('authors.follow', $writer) }}">
                            @csrf
                            <button type="submit" class="w-full brutalist-btn-black {{ $isFollowingWriter ? 'opacity-70 cursor-default' : '' }}" @disabled($isFollowingWriter || auth()->id() === $writer->id)>
                                {{ auth()->id() === $writer->id ? 'Your Profile' : ($isFollowingWriter ? 'Following' : 'Follow') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center brutalist-btn-black">Login to Follow</a>
                    @endauth
                </div>
            </section>

            <section class="p-8 lg:p-16">
                <div class="flex items-end justify-between gap-6 mb-12">
                    <h2 class="font-black text-5xl lg:text-7xl uppercase tracking-tighter leading-none">Published <br> Files</h2>
                    <a href="{{ route('authors') }}" class="font-mono text-xs uppercase underline">Back to authors</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0 border-t-2 border-l-2 border-black dark:border-white">
                    @forelse ($publishedPosts as $post)
                        <x-ui.card
                            :image="$post->thumbnail ? asset('storage/'.$post->thumbnail) : 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800'"
                            :image-alt="$post->title"
                            :file-ref="'ART_'.str_pad((string) $post->id, 3, '0', STR_PAD_LEFT)"
                            :title="$post->title"
                            :author="$post->author"
                            :date="$post->created_at?->format('m.d.y') ?? now()->format('m.d.y')"
                            :href="url('/articles/'.$post->slug)"
                        />
                    @empty
                        <div class="md:col-span-2 lg:col-span-3 p-4 border-r-2 border-b-2 border-black dark:border-white">
                            <x-ui.empaty
                                title="Belum ada artikel"
                                message="Writer ini belum memiliki artikel yang dipublikasikan."
                            />
                        </div>
                    @endforelse
                </div>
            </section>
        </main>

        @include('components.footer')
    </div>
</body>
</html>
