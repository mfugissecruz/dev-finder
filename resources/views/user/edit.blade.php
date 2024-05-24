<x-layouts.app>
    <x-form.template action="{{ route('user.update', ['user' => $user]) }}">
        @method('PUT')
        <div>
            <x-form.input-label for="x_name" :required="true">Name:</x-form.input-label>
            <x-form.input-text id="x_name" name="name" type="name" value="{{ old('name', $user->name) }}" required/>
            <x-form.input-error for="name" />
        </div>

        @unless(auth()->user()->is($user))
            <div>
                <x-form.input-label for="" :required="true">Função:</x-form.input-label>
                <div class="flex flex-row gap-2.5">
                    <div class="flex items-center justify-center gap-1.5">
                        <input
                            id="x_role_cto"
                            type="radio"
                            name="role"
                            value="cto"
                            {{ old('role', $user->role) === 'cto' ? 'checked' : '' }}
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
                            {{ old('role', $user->role) === 'default' ? 'checked' : '' }}
                            required
                        />
                        <x-form.input-label for="x_role_default">Usuário Padrão</x-form.input-label>
                    </div>
                </div>
                <x-form.input-error for="role" />
            </div>
        @endunless

        <div>
            <x-form.input-label for="x_email" :required="true">Email:</x-form.input-label>
            <x-form.input-text id="x_email" name="email" type="email" value="{{ old('email', $user->email) }}" required/>
            <x-form.input-error for="email" />
        </div>

        @unless(auth()->user()->is($user))
            <div>
                <x-form.input-label for="x_email_confirmation" :required="true">Email Confirmation:</x-form.input-label>
                <x-form.input-text id="x_email_confirmation" name="email_confirmation" type="email" value="{{ old('email_confirmation') }}" required/>
                <x-form.input-error for="email_confirmation" />
            </div>

            <div>
                <x-form.button-submit>
                    Editar
                </x-form.button-submit>
            </div>
        @endunless
    </x-form.template>
</x-layouts.app>
