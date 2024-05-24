<x-layouts.app>
    <x-form.template action="{{ route('user.store') }}">
        <div>
            <x-form.input-label for="x_name" :required="true">Nome:</x-form.input-label>
            <x-form.input-text id="x_name" name="name" type="name" value="{{ old('name') }}" required/>
            <x-form.input-error for="name" />
        </div>

        <div>
            <x-form.input-label for="" :required="true">Função:</x-form.input-label>
            <div class="flex flex-row gap-2.5">
                <div class="flex items-center justify-center gap-1.5">
                    <input
                        id="x_role_cto"
                        type="radio"
                        name="role"
                        value="cto"
                        {{ old('role') === 'cto' ? 'checked' : '' }}
                        required
                    />
                    <x-form.input-label for="x_role_cto">CTO</x-form.input-label>
                </div>

                <div class="flex items-center justify-center gap-1.5">
                    <input
                        id="x_role_default"
                        type="radio"
                        name="role"
                        value="default"
                        {{ old('role') === 'default' ? 'checked' : '' }}
                        required
                    />
                    <x-form.input-label for="x_role_default">Usuário Padrão</x-form.input-label>
                </div>
            </div>
            <x-form.input-error for="role" />
        </div>

        <div>
            <x-form.input-label for="x_email" :required="true">Email:</x-form.input-label>
            <x-form.input-text id="x_email" name="email" type="email" value="{{ old('email') }}" required/>
            <x-form.input-error for="email" />
        </div>

        <div>
            <x-form.input-label for="x_email_confirmation" :required="true">Confirmação do Email:</x-form.input-label>
            <x-form.input-text id="x_email_confirmation" name="email_confirmation" type="email" value="{{ old('email_confirmation') }}" required/>
            <x-form.input-error for="email_confirmation" />
        </div>

        <div>
            <x-form.input-label for="x_password" :required="true">Senha:</x-form.input-label>
            <x-form.input-text id="x_password" name="password" type="password" value="{{ old('password') }}" />
            <x-form.input-error for="x_password" />
        </div>

        <div>
            <x-form.button-submit>
                Salvar
            </x-form.button-submit>
        </div>
    </x-form.template>
</x-layouts.app>
