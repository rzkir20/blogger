@once
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
@endonce

<header class="brutalist-border-b bg-white sticky top-0 z-50">
    <div class="flex justify-between items-center px-6 h-20">
        <a href="{{ url('/') }}" id="nav-brand" class="font-black text-4xl tracking-tighter">ARCHIVE.</a>

        <nav class="hidden lg:flex items-center h-full">
            <a href="#" id="nav-explore" class="h-full px-8 flex items-center font-bold uppercase text-sm border-l-2 border-black hover-red">Explore</a>
            <a href="#" id="nav-authors" class="h-full px-8 flex items-center font-bold uppercase text-sm border-l-2 border-black hover-red">Authors</a>
            <a href="#" id="nav-archive" class="h-full px-8 flex items-center font-bold uppercase text-sm border-l-2 border-black hover-red">The Files</a>
        </nav>

        <div class="flex items-center h-full">
            <button id="mode-toggle" class="h-full px-6 border-l-2 border-black hover-red flex items-center" type="button" aria-label="Toggle dark mode">
                <iconify-icon icon="lucide:sun" class="text-xl"></iconify-icon>
            </button>
            <a href="#" id="nav-cta" class="h-full px-10 flex items-center font-black uppercase text-sm border-l-2 border-black bg-black text-white hover:bg-red-600 transition-colors">Write +</a>
        </div>
    </div>
</header>
