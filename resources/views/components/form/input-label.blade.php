@props(['required' => false])
<label {{ $attributes->merge(['class' => 'block text-sm font-medium leading-6 text-gray-100 mb-2']) }} >
    <span>
        <span>{{ $slot }}</span>
        @if ($required)
            <span class="text-red-700">*</span>
        @endif
    </span>
</label>
