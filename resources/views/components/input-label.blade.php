@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-app']) }}>
    {{ $value ?? $slot }}
</label>
