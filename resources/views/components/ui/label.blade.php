@props([
    'for' => null,
    'text' => null,
])

<label
    @if ($for) for="{{ $for }}" @endif
    {{ $attributes->merge(['class' => 'font-mono text-xs font-black uppercase']) }}
>
    {{ $text ?? $slot }}
</label>
