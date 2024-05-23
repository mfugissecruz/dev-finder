@props(['disabled' => false])
<input
    {{ $attributes }}
    {{ $disabled ? 'disabled' : '' }}
/>
