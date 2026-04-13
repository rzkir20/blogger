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
        @include('components.header')

        <main class="flex-1 p-8 lg:p-16">
            <div class="max-w-3xl">
                <div class="mb-8 font-mono text-xs uppercase tracking-widest bg-red-600 text-white px-3 py-1 inline-block">
                    Node_Class / Super_Admin
                </div>
                <h1 class="font-black text-6xl md:text-8xl uppercase tracking-tighter leading-[0.85] mb-8">
                    Command <br> Deck.
                </h1>
                <p class="font-mono text-sm uppercase opacity-70 mb-10">
                    Session: {{ Auth::user()->email }} — full archive authority on this node.
                </p>
                <div class="flex flex-wrap gap-4 font-mono text-xs uppercase">
                    <a href="{{ url('/') }}" class="inline-block px-6 py-3 brutalist-border hover-red">Index</a>
                    <a href="{{ url('/explore') }}" class="inline-block px-6 py-3 brutalist-border hover-red">The_Vault</a>
                    <a href="{{ url('/writer') }}" class="inline-block px-6 py-3 brutalist-border hover-red">Writer_Node</a>
                    <a href="{{ url('/reader') }}" class="inline-block px-6 py-3 brutalist-border hover-red">Reader_Node</a>
                </div>
            </div>
        </main>
    </div>

    <script>
        (function () {
            const toggleButton = document.getElementById('mode-toggle');
            const root = document.getElementById('root');
            if (toggleButton && root) {
                toggleButton.addEventListener('click', function () {
                    document.body.classList.toggle('dark-mode');
                    root.classList.toggle('dark-mode');
                });
            }
        })();
    </script>
</body>
</html>
