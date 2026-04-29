<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Archive | Writer Dashboard</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
        ])
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
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-12 relative pb-32">
                <section class="space-y-4 border-b-2 border-zinc-900 dark:border-zinc-300 pb-8">
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Archives / Content Management</p>
                    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                        <h1 class="font-black text-5xl sm:text-6xl lg:text-8xl leading-[0.85] tracking-tighter uppercase">
                            Posts<br>Archive.
                        </h1>
                        <a href="{{ route('writer.posts.create') }}" id="header-new-post-btn" class="brutalist-btn-black inline-block text-center shrink-0">
                            Create New Entry +
                        </a>
                    </div>
                </section>

                <section class="border-t-2 border-zinc-900 dark:border-zinc-300 overflow-x-auto">
                    <table class="w-full border-collapse min-w-[720px]">
                        <thead>
                            <tr class="border-b border-zinc-900 dark:border-zinc-300 text-left uppercase font-mono text-[10px] font-black tracking-widest bg-gray-50 dark:bg-zinc-900">
                                <th class="p-6 min-w-[300px]">Publication Title</th>
                                <th class="p-6">Category</th>
                                <th class="p-6">Author</th>
                                <th class="p-6">Status</th>
                                <th class="p-6">Views / Likes / Comments</th>
                                <th class="p-6">Updated</th>
                                <th class="p-6 text-right">Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10 dark:divide-white/10">
                            @forelse ($posts as $post)
                                <tr class="group hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors cursor-default">
                                    <td class="p-6">
                                        <h3 class="text-xl md:text-2xl font-black uppercase leading-tight">{{ $post->title }}</h3>
                                        <p class="font-mono text-[10px] font-bold mt-1 opacity-60">{{ $post->description }}</p>
                                        @if (! empty($post->tags))
                                            <p class="font-mono text-[10px] font-bold mt-2 opacity-60">#{{ implode(' #', $post->tags) }}</p>
                                        @endif
                                    </td>
                                    <td class="p-6 whitespace-nowrap text-sm font-black uppercase">{{ $post->category }}</td>
                                    <td class="p-6 whitespace-nowrap text-sm font-black uppercase">{{ $post->author }}</td>
                                    <td class="p-6 whitespace-nowrap text-sm font-black uppercase">
                                        @if ($post->is_published)
                                            <span class="inline-block border-2 border-zinc-900 dark:border-zinc-300 px-3 py-1 font-mono text-[10px] font-black uppercase">Published</span>
                                        @else
                                            <span class="inline-block border-2 border-dashed border-zinc-900 dark:border-zinc-300 px-3 py-1 font-mono text-[10px] font-black uppercase">Draft</span>
                                        @endif
                                    </td>
                                    <td class="p-6 whitespace-nowrap">
                                        <span class="font-mono text-[10px] font-bold uppercase block">VIEWS: {{ number_format($post->view_list_count) }}</span>
                                        <span class="font-mono text-[10px] font-bold uppercase block">LIKES: {{ number_format($post->like_list_count) }}</span>
                                        <span class="font-mono text-[10px] font-bold uppercase block">COMMENTS: {{ number_format($post->comments_list_count) }}</span>
                                    </td>
                                    <td class="p-6 whitespace-nowrap text-sm font-black uppercase">{{ $post->updated_at?->format('d M Y') }}</td>
                                    <td class="p-6 text-right">
                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('writer.posts.priview', $post) }}" class="hover:scale-125 transition-transform" aria-label="Preview"><iconify-icon icon="lucide:eye" class="text-xl"></iconify-icon></a>
                                            <a href="{{ route('writer.posts.edit', $post) }}" class="hover:scale-125 transition-transform" aria-label="Edit"><iconify-icon icon="lucide:edit-3" class="text-xl"></iconify-icon></a>
                                            <form method="post" action="{{ route('writer.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:scale-125 transition-transform hover:text-red-500 dark:hover:text-red-600" aria-label="Delete">
                                                    <iconify-icon icon="lucide:trash-2" class="text-xl"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-6">
                                        <x-ui.empaty
                                            title="Belum ada post"
                                            message='Klik "Create New Entry +" untuk membuat artikel pertama.'
                                            action-label="Create New Entry +"
                                            :action-href="route('writer.posts.create')"
                                        />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>

                <section class="pt-4">
                    <p class="font-mono text-xs font-black uppercase tracking-widest opacity-60">Total Arsip: {{ $posts->count() }}</p>
                </section>

                <footer class="absolute bottom-0 left-0 right-0 border-t border-zinc-900 dark:border-zinc-300 p-8 px-6 md:px-12 writer-app bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <span class="text-lg font-black tracking-tighter uppercase">Writer. Archive Unit</span>
                        <p class="font-mono text-[10px] font-black uppercase opacity-60">© {{ date('Y') }}. Systematic Editorial Control.</p>
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
