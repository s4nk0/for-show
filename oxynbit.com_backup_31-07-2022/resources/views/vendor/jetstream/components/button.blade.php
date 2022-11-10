<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-success waves-effect px-4']) }}>
    {{ $slot }}
</button>
