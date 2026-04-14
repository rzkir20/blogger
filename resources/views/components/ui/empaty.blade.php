@props([
    'title' => 'Data belum tersedia',
    'message' => 'Belum ada data untuk ditampilkan saat ini.',
    'actionLabel' => null,
    'actionHref' => null,
])

<div {{ $attributes->merge(['class' => 'brutalist-border p-8 md:p-10 text-center space-y-4']) }}>
    <div class="mx-auto w-14 h-14 border-2 border-zinc-900 dark:border-zinc-300 flex items-center justify-center">
        <iconify-icon icon="lucide:inbox" class="text-2xl"></iconify-icon>
    </div>

    <div class="space-y-2">
        <h3 class="font-black text-2xl uppercase tracking-tighter">{{ $title }}</h3>
        <p class="font-mono text-[11px] uppercase opacity-60">{{ $message }}</p>
    </div>

    @if ($actionLabel && $actionHref)
        <a href="{{ $actionHref }}" class="inline-block brutalist-btn-black">
            {{ $actionLabel }}
        </a>
    @endif
</div>
