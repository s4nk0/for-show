@props(['value'])

<label {{ $attributes->merge(['class' => 'mr-sm-2']) }}>
    {{ $value ?? $slot }}
</label>
