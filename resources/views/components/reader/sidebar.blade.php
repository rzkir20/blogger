@php
    $active = $active ?? 'overview';
    $user = Auth::user();
@endphp

<aside class="writer-scroll w-full md:w-72 border-b-2 md:border-b-0 md:border-r-2 border-zinc-900 dark:border-zinc-300 sticky top-0 md:h-screen flex flex-col z-40 bg-white dark:bg-zinc-950 shrink-0 text-zinc-950 dark:text-zinc-50">
    <div class="p-8 border-b-2 border-zinc-900 dark:border-zinc-300">
        <a href="{{ url('/') }}" class="font-black text-3xl tracking-tighter">READER.</a>
        <p class="font-mono text-[10px] uppercase opacity-50 mt-2">
            <a href="{{ url('/') }}" class="underline hover:text-red-600 dark:hover:text-red-400">← Archive</a>
        </p>
    </div>

    <nav class="flex-1 flex flex-col border-zinc-900 dark:border-zinc-300">
        <a href="{{ route('reader.home') }}"
            @class([
                'p-6 md:px-8 md:py-6 font-bold uppercase text-sm border-b border-zinc-900 dark:border-zinc-300 flex items-center gap-3 transition-all duration-200',
                'bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950' => $active === 'overview',
                'text-zinc-950 dark:text-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950' => $active !== 'overview',
            ])>
            <iconify-icon icon="lucide:layout-dashboard" class="text-xl shrink-0"></iconify-icon>
            Overview
        </a>
        <a href="{{ url('/explore') }}"
            @class([
                'p-6 md:px-8 md:py-6 font-bold uppercase text-sm border-b border-zinc-900 dark:border-zinc-300 flex items-center gap-3 transition-all duration-200',
                'bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950' => $active === 'explore',
                'text-zinc-950 dark:text-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950' => $active !== 'explore',
            ])>
            <iconify-icon icon="lucide:compass" class="text-xl shrink-0"></iconify-icon>
            Explore
        </a>
        <a href="{{ url('/search') }}"
            @class([
                'p-6 md:px-8 md:py-6 font-bold uppercase text-sm border-b border-zinc-900 dark:border-zinc-300 flex items-center gap-3 transition-all duration-200',
                'bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950' => $active === 'search',
                'text-zinc-950 dark:text-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950' => $active !== 'search',
            ])>
            <iconify-icon icon="lucide:search" class="text-xl shrink-0"></iconify-icon>
            Search
        </a>
    </nav>

    <div class="p-8 mt-auto border-t-2 border-zinc-900 dark:border-zinc-300 hidden md:block space-y-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-zinc-950 dark:bg-zinc-100 flex items-center justify-center text-zinc-50 dark:text-zinc-950 shrink-0">
                <iconify-icon icon="lucide:user" class="text-2xl"></iconify-icon>
            </div>
            <div class="min-w-0 flex-1">
                <p class="font-black text-sm truncate uppercase">{{ $user->name }}</p>
                <p class="text-[10px] font-bold uppercase opacity-50">Reader</p>
            </div>
        </div>
        <div class="flex items-center justify-between gap-3">
            <span class="text-[10px] font-mono font-bold uppercase tracking-wide opacity-60">Theme</span>
            <x-ui.thema-toggler />
        </div>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left text-xs font-black uppercase underline hover:no-underline">
                Log out
            </button>
        </form>
    </div>
</aside>
