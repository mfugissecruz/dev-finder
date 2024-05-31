<div wire:ignore>
    <select
        {!! $attributes !!}
        x-init="$el._tom = new Tom($el, {
            multiple: true,
            plugins: ['remove_button']
        })"
        multiple
    >
        {{ $slot }}
    </select>
</div>

