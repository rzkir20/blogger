@props([
    'title' => null,
    'subtitle' => null,
    'wrapperClass' => '',
    'tableClass' => 'w-full text-left',
    'headClass' => '',
    'bodyClass' => '',
])

<section @class([
    'border-2 border-zinc-900 dark:border-zinc-300 overflow-hidden bg-white dark:bg-zinc-950',
    $wrapperClass,
])>
    @if ($title || $subtitle)
        <div class="px-4 py-3 border-b-2 border-zinc-900 dark:border-zinc-300 flex items-center justify-between gap-3">
            <p class="font-black uppercase text-sm tracking-wide">{{ $title }}</p>
            @if ($subtitle)
                <p class="font-mono text-[10px] uppercase opacity-60">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="{{ $tableClass }}">
            <thead class="{{ $headClass }}">
                {{ $head }}
            </thead>
            <tbody class="{{ $bodyClass }}">
                {{ $body }}
            </tbody>
        </table>
    </div>
</section>
