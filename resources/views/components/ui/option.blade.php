@props([
    'value' => '',
    'label' => null,
    'selected' => false,
    'disabled' => false,
])

<option
    value="{{ $value }}"
    @selected($selected)
    @disabled($disabled)
    {{ $attributes }}
>
    {{ $label ?? $slot }}
</option>
