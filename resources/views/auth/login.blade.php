<x-form.template action="{{ route('login.store') }}">
    <div>
        <x-form.input-label for="x_email" :required="true">Email:</x-form.input-label>
        <x-form.input-text id="x_email" name="email" type="email" value="{{ old('email') }}" required/>
        <x-form.input-error for="email" />
    </div>

    <div>
        <x-form.input-label for="x_password" :required="true">Senha:</x-form.input-label>
        <x-form.input-text id="x_password" name="password" type="password" value="{{ old('password') }}" />
    </div>

    <div>
        <x-form.button-submit>
            Entrar
        </x-form.button-submit>
    </div>
</x-form.template>
