<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Post | Writer Dashboard</title>
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
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'posts'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-8">
                <section class="space-y-4 border-b-2 border-zinc-900 dark:border-zinc-300 pb-8">
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Posts / Preview</p>
                    <h1 class="font-black text-5xl sm:text-6xl tracking-tighter uppercase">{{ $post->title }}</h1>
                </section>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="brutalist-border p-4">
                        <p class="font-mono text-[10px] uppercase opacity-60">Category</p>
                        <p class="font-black uppercase">{{ $post->category }}</p>
                    </div>
                    <div class="brutalist-border p-4">
                        <p class="font-mono text-[10px] uppercase opacity-60">Author</p>
                        <p class="font-black uppercase">{{ $post->author }}</p>
                    </div>
                    <div class="brutalist-border p-4">
                        <p class="font-mono text-[10px] uppercase opacity-60">Status</p>
                        <p class="font-black uppercase">{{ $post->is_published ? 'Published' : 'Draft' }}</p>
                    </div>
                    <div class="brutalist-border p-4">
                        <p class="font-mono text-[10px] uppercase opacity-60">Views / Likes / Comments</p>
                        <p class="font-black uppercase">{{ number_format($post->view_list_count) }} / {{ number_format($post->like_list_count) }} / {{ number_format($post->comments_list_count) }}</p>
                    </div>
                    <div class="brutalist-border p-4">
                        <p class="font-mono text-[10px] uppercase opacity-60">Created At</p>
                        <p class="font-black uppercase">{{ $post->created_at?->format('d M Y H:i') }}</p>
                    </div>
                    <div class="brutalist-border p-4">
                        <p class="font-mono text-[10px] uppercase opacity-60">Updated At</p>
                        <p class="font-black uppercase">{{ $post->updated_at?->format('d M Y H:i') }}</p>
                    </div>
                </div>

                @if ($post->thumbnail)
                    <section class="space-y-2">
                        <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Thumbnail</p>
                        <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->title }}" class="w-full max-w-xl brutalist-border object-cover">
                    </section>
                @endif

                <section class="space-y-2">
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Description</p>
                    <div class="brutalist-border p-4">{{ $post->description }}</div>
                </section>

                @if (! empty($post->tags))
                    <section class="space-y-2">
                        <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Tags</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($post->tags as $tag)
                                <span class="inline-flex px-3 py-1 border-2 border-zinc-900 dark:border-zinc-300 font-mono text-[10px] font-black uppercase">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="space-y-2">
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Content</p>
                    <article class="brutalist-border p-6 leading-relaxed prose max-w-none dark:prose-invert">{!! $post->content !!}</article>
                </section>

                <div class="flex gap-4">
                    <a href="{{ route('writer.posts') }}" class="brutalist-btn text-center">Back</a>
                    <a href="{{ route('writer.posts.edit', $post) }}" class="brutalist-btn-black text-center">Edit</a>
                </div>
            </main>
            @include('components.writer.profile-aside')
        </div>
    </div>
</body>
</html>
