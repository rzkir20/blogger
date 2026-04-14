@props([
    'size' => 'sm',
    'label' => 'Loading...',
])

@php
    $sizeClass = match ($size) {
        'xs' => 'h-3 w-3 border-[1.5px]',
        'md' => 'h-5 w-5 border-2',
        'lg' => 'h-6 w-6 border-2',
        default => 'h-4 w-4 border-2',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2']) }}>
    <span class="{{ $sizeClass }} animate-spin rounded-full border-current border-t-transparent" aria-hidden="true"></span>
    <span class="font-mono text-[10px] font-black uppercase tracking-widest">{{ $label }}</span>
</span>
