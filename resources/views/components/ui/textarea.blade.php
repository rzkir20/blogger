<textarea
    {{ $attributes->merge([
        'class' => 'w-full p-5 brutalist-border bg-transparent font-mono text-sm uppercase resize-none transition-all',
    ]) }}
>{{ $slot }}</textarea>
