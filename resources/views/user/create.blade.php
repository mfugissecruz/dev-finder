<x-layouts.app>
    <div class="container mx-auto">
        <!-- Formulário de Criação -->
        <div class="w-full p-5 bg-zinc-900 h-auto rounded-lg">
            <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nome -->
                <div>
                    <x-form.input-label for="x_name" :required="true">Name:</x-form.input-label>
                    <x-form.input-text id="x_name" name="name" type="text" value="{{ old('name') }}" required />
                    <x-form.input-error for="name" class="mt-2 text-sm text-red-600"/>
                </div>

                <!-- Função -->
                <div>
                    <x-form.input-label for="x_role" :required="true">Role:</x-form.input-label>
                    <div class="flex flex-row gap-4 mt-1">
                        <div class="flex items-center">
                            <input id="x_role_cto" type="radio" name="role" value="cto" {{ old('role') === 'cto' ? 'checked' : '' }} required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"/>
                            <x-form.input-label for="x_role_cto" class="ml-2 mb-0 block text-sm font-medium text-gray-100">CTO</x-form.input-label>
                        </div>
                        <div class="flex items-center">
                            <input id="x_role_default" type="radio" name="role" value="default" {{ old('role') === 'default' ? 'checked' : '' }} required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"/>
                            <x-form.input-label for="x_role_default" class="ml-2 mb-0 block text-sm font-medium text-gray-100">Default User</x-form.input-label>
                        </div>
                    </div>
                    <x-form.input-error for="role" class="mt-2 text-sm text-red-600"/>
                </div>

                <!-- Email -->
                <div>
                    <x-form.input-label for="x_email" :required="true">Email:</x-form.input-label>
                    <x-form.input-text id="x_email" name="email" type="email" value="{{ old('email') }}" required />
                    <x-form.input-error for="email" class="mt-2 text-sm text-red-600"/>
                </div>

                <!-- Confirmação de Email -->
                <div>
                    <x-form.input-label for="x_email_confirmation" :required="true">Email Confirmation:</x-form.input-label>
                    <x-form.input-text id="x_email_confirmation" name="email_confirmation" type="email" value="{{ old('email_confirmation') }}" required />
                    <x-form.input-error for="email_confirmation" class="mt-2 text-sm text-red-600"/>
                </div>

                <!-- Senha -->
                <div>
                    <x-form.input-label for="x_password" :required="true">Password:</x-form.input-label>
                    <x-form.input-text id="x_password" name="password" type="password" value="{{ old('password') }}" required />
                    <x-form.input-error for="password" class="mt-2 text-sm text-red-600"/>
                </div>

                <!-- Botão de Submit -->
                <div class="flex items-center justify-end">
                    <div class="flex items-center">
                        <x-button-link :route="route('user.index')" caption="See Users" />

                        <x-form.button-submit class="bg-emerald-500 hover:bg-emerald-600 focus:ring-emerald-500">
                            Save
                        </x-form.button-submit>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
