@props([
    'type' => 'text',
])

<input
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'w-full p-5 brutalist-border bg-transparent font-mono text-sm transition-all',
    ]) }}
>
