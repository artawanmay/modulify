<button {{ $attributes->merge(['type' => 'submit', 'class' => 'glass-btn glass-btn-primary']) }}>
    {{ $slot }}
</button>
