@props([
    'type' => 'button',
])

<button type="{{ $type }}" {{ $attributes }}>
    {{ $slot }}
</button>
