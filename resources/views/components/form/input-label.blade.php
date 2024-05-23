@props(['required' => false])
<label {{ $attributes }}>
    <span>
        <span>{{ $slot }}</span>
        @if ($required)
            <span>*</span>
        @endif
    </span>
</label>
