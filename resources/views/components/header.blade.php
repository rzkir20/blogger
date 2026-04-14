@once
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
    {!! ToastMagic::styles() !!}
    {!! ToastMagic::scripts() !!}
@endonce
@php
    $isExplore = request()->is('explore');
    $isAuthors = request()->is('authors');
    $isChangelog = request()->is('changelog');
@endphp

<header class="brutalist-border-b bg-white sticky top-0 z-50">
    <div class="flex justify-between items-center h-20">
        <a href="{{ url('/') }}" id="nav-brand" class="font-black text-4xl tracking-tighter pl-6">ARCHIVE.</a>

        <nav class="hidden lg:flex items-center h-full">
            <a href="{{ url('/explore') }}" id="nav-explore" @class([
                'h-full px-8 flex items-center font-bold uppercase text-sm border-l-2 border-black',
                'bg-black text-white' => $isExplore,
                'hover-red' => ! $isExplore,
            ])>Explore</a>
            <a href="{{ url('/authors') }}" id="nav-authors" @class([
                'h-full px-8 flex items-center font-bold uppercase text-sm border-l-2 border-black',
                'bg-black text-white' => $isAuthors,
                'hover-red' => ! $isAuthors,
            ])>Authors</a>
            <a href="{{ url('/changelog') }}" id="nav-archive" @class([
                'h-full px-8 flex items-center font-bold uppercase text-sm border-l-2 border-black',
                'bg-black text-white' => $isChangelog,
                'hover-red' => ! $isChangelog,
            ])>The Files</a>
        </nav>

        <div class="flex items-center h-full">
            <a href="{{ url('/search') }}" id="nav-search" class="h-full px-6 border-l-2 border-black hover-red flex items-center" aria-label="Search">
                <iconify-icon icon="lucide:search" class="text-xl"></iconify-icon>
            </a>
            <button id="mode-toggle" class="h-full px-6 border-l-2 border-black hover-red flex items-center" type="button" aria-label="Toggle dark mode">
                <iconify-icon icon="lucide:sun" class="text-xl"></iconify-icon>
            </button>
            <a href="{{ url('/login') }}" id="nav-cta" class="h-full px-10 flex items-center font-black uppercase text-sm border-l-2 border-black bg-black text-white hover:bg-red-600 transition-colors">Write +</a>
        </div>
    </div>
</header>
