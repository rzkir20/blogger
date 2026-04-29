<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Super Admin</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col">
        <div class="flex flex-1 flex-col md:flex-row">
            @include('components.dashboard.sidebar', ['active' => 'overview'])

            <main class="flex-1 p-8 lg:p-16">
                <div class="max-w-4xl">
                    <div class="mb-8 font-mono text-xs uppercase tracking-widest bg-red-600 text-white px-3 py-1 inline-block">
                        Node_Class / Super_Admin
                    </div>
                    <h1 class="font-black text-6xl md:text-8xl uppercase tracking-tighter leading-[0.85] mb-8">
                        Command <br> Deck.
                    </h1>
                    <p class="font-mono text-sm uppercase opacity-70 mb-10">
                        Session: {{ Auth::user()->email }} — reader/writer nodes cannot open this deck; you may inspect their consoles below.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-4 font-mono text-xs uppercase mb-12">
                        <a href="{{ url('/writer') }}" class="px-6 py-4 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors">
                            Open Writer Node
                        </a>
                        <a href="{{ url('/reader') }}" class="px-6 py-4 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors">
                            Open Reader Node
                        </a>
                    </div>

                    <section class="border-2 border-zinc-900 dark:border-zinc-300 p-6 md:p-8">
                        <h2 class="font-black text-2xl uppercase mb-4">Operations Brief</h2>
                        <p class="font-mono text-xs uppercase opacity-70 leading-relaxed">
                            Use this deck to monitor access, jump between writer and reader nodes, and manage the overall publication system.
                        </p>
                    </section>
                </div>
            </main>

            @include('components.dashboard.profile')
        </div>
    </div>
</body>
</html>
