<button {{ $attributes->merge(['type' => 'submit', 'class' => 'glass-btn glass-btn-danger']) }}>
    {{ $slot }}
</button>
