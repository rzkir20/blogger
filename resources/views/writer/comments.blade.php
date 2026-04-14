<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments | Writer Dashboard</title>
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
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'comments'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-12">
                <section class="space-y-4 border-b border-zinc-900 dark:border-zinc-300 pb-8">
                    <p class="font-mono text-xs uppercase font-black tracking-[0.2em] opacity-80">Community / Discussion Management</p>
                    <h1 class="font-black text-5xl sm:text-6xl lg:text-8xl leading-[0.85] tracking-tighter uppercase">
                        Comments.
                    </h1>
                </section>

                <section class="space-y-8">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 border-b border-zinc-900 dark:border-zinc-300 pb-4">
                        <h2 class="font-black text-4xl tracking-tighter uppercase">Incoming Comments ({{ number_format($comments->total()) }})</h2>
                    </div>

                    @if ($comments->count() > 0)
                        <div class="space-y-4">
                            @foreach ($comments as $commentItem)
                                <article class="brutalist-border p-6 space-y-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="space-y-1 min-w-0">
                                            <p class="font-mono text-[10px] uppercase opacity-60">Post</p>
                                            <p class="font-black uppercase truncate">{{ $commentItem->post?->title ?? 'Untitled Post' }}</p>
                                        </div>
                                        <p class="font-mono text-[10px] uppercase opacity-60 shrink-0">{{ $commentItem->created_at?->format('d M Y H:i') }}</p>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <img
                                            src="{{ $commentItem->user?->avatar_path ? asset('storage/'.$commentItem->user->avatar_path) : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=120' }}"
                                            alt="{{ $commentItem->user?->name ?? 'Anonymous' }}"
                                            class="w-10 h-10 object-cover border-2 border-zinc-900 dark:border-zinc-300 shrink-0"
                                        >
                                        <div class="min-w-0">
                                            <p class="font-black uppercase truncate">{{ $commentItem->user?->name ?? 'Anonymous' }}</p>
                                            <p class="font-mono text-[10px] uppercase opacity-60">{{ $commentItem->user?->role ? str_replace('_', ' ', strtoupper($commentItem->user->role)) : 'MEMBER' }}</p>
                                        </div>
                                    </div>

                                    <p class="leading-relaxed">{{ $commentItem->comment }}</p>
                                </article>
                            @endforeach
                        </div>

                        <x-ui.pagination :paginator="$comments" />
                    @else
                        <x-ui.empaty
                            title="Belum ada komentar"
                            message="Belum ada komentar yang masuk di post kamu."
                        />
                    @endif
                </section>
            </main>

            @include('components.writer.profile-aside')
        </div>
    </div>
</body>
</html>
