@props(['active'])

@php
$classes = ($active ?? false)
            ? 'glass-btn w-full justify-start text-sm'
            : 'glass-btn glass-btn-ghost w-full justify-start text-sm';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
