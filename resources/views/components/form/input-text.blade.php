@props(['disabled' => false])
<input
    {{ $attributes->merge(['class' => 'w-full h-12 rounded-md border border-zinc-600 bg-zinc-800 text-zinc-200 focus:ring-0 focus:border-blue-500 mb-1.5']) }}
    {{ $disabled ? 'disabled' : '' }}
/>
