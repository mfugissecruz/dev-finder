<x-form.template action="{{ route('login.store') }}" button="Entrar">
    <div>
        <x-form.input-label for="x_email" :required="true">Email:</x-form.input-label>
        <x-form.input-text id="x_email" name="email" type="email" value="{{ old('email') }}" required/>
        <x-form.input-error for="email" />
    </div>

    <div>
        <x-form.input-label for="x_password" :required="true">Senha:</x-form.input-label>
        <x-form.input-text id="x_password" name="password" type="password" value="{{ old('password') }}" />
    </div>
</x-form.template>
