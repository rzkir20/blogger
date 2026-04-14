@props([
    'paginator',
])

@if ($paginator->hasPages())
    <div {{ $attributes->merge(['class' => 'flex flex-wrap items-center justify-center gap-2']) }}>
        @if ($paginator->onFirstPage())
            <span class="h-12 border-2 border-zinc-900 dark:border-zinc-300 px-6 flex items-center justify-center font-black uppercase tracking-widest opacity-40">
                Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="h-12 border-2 border-zinc-900 dark:border-zinc-300 px-6 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-black uppercase tracking-widest text-zinc-950 dark:text-zinc-50">
                Prev
            </a>
        @endif

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page === $paginator->currentPage())
                <span class="w-12 h-12 border border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 font-bold">
                    {{ str_pad((string) $page, 2, '0', STR_PAD_LEFT) }}
                </span>
            @else
                <a href="{{ $url }}" class="w-12 h-12 border border-zinc-900 dark:border-zinc-300 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-bold text-zinc-950 dark:text-zinc-50">
                    {{ str_pad((string) $page, 2, '0', STR_PAD_LEFT) }}
                </a>
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="h-12 border-2 border-zinc-900 dark:border-zinc-300 px-6 flex items-center justify-center hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all font-black uppercase tracking-widest text-zinc-950 dark:text-zinc-50">
                Next
            </a>
        @else
            <span class="h-12 border-2 border-zinc-900 dark:border-zinc-300 px-6 flex items-center justify-center font-black uppercase tracking-widest opacity-40">
                Next
            </span>
        @endif
    </div>
@endif
