@props(['action', 'method' => 'POST', 'button' => 'Salvar'])
<form method="POST" action="{{ $action }}" {{ $attributes }}>
    @csrf
    {{ $slot }}

    <x-form.button-submit>
        {{ $button }}
    </x-form.button-submit>
</form>
