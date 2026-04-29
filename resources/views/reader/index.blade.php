<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Reader Node</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col">
        <div class="flex flex-1 flex-col md:flex-row">
            @include('components.reader.sidebar', ['active' => 'overview'])

            <main class="flex-1 p-8 lg:p-16">
                <div class="max-w-4xl">
                    <div class="mb-8 font-mono text-xs uppercase tracking-widest bg-black text-white px-3 py-1 inline-block">
                        Node_Class / Reader
                    </div>
                    <h1 class="font-black text-6xl md:text-8xl uppercase tracking-tighter leading-[0.85] mb-8">
                        Reader <br> Desk.
                    </h1>
                    <p class="font-mono text-sm uppercase opacity-70 mb-10">
                        Session: {{ Auth::user()->email }} — browse and follow transmissions from this node.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-4 font-mono text-xs uppercase mb-12">
                        <a href="{{ url('/explore') }}" class="px-6 py-4 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors">
                            Explore Articles
                        </a>
                        <a href="{{ url('/search') }}" class="px-6 py-4 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors">
                            Search Topics
                        </a>
                    </div>

                    <section class="border-2 border-zinc-900 dark:border-zinc-300 p-6 md:p-8">
                        <h2 class="font-black text-2xl uppercase mb-4">Quick Brief</h2>
                        <p class="font-mono text-xs uppercase opacity-70 leading-relaxed">
                            Track fresh stories, follow authors you trust, and keep your reading flow focused from one dashboard.
                        </p>
                    </section>
                </div>
            </main>

            @include('components.reader.profile-aside')
        </div>
    </div>
</body>
</html>
