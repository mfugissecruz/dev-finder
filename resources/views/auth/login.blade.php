<x-layouts.app>
    <div class="flex items-center justify-center mx-4 h-[calc(100vh-10rem)]">
        <div class="w-full max-w-md bg-zinc-800 p-8 rounded-lg shadow-md">
            <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-form.input-label for="x_email" :required="true" class="block text-sm font-medium text-gray-100">Email:</x-form.input-label>
                    <x-form.input-text id="x_email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                    <x-form.input-error for="email" class="mt-2 text-sm text-red-600"/>
                </div>

                <div>
                    <x-form.input-label for="x_password" :required="true" class="block text-sm font-medium text-gray-100">Password:</x-form.input-label>
                    <x-form.input-text id="x_password" name="password" type="password" value="{{ old('password') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                    <x-form.input-error for="password" class="mt-2 text-sm text-red-600"/>
                </div>

                <div class="my-6">
                    <x-form.button-submit class="min-w-full">
                        Sign In
                    </x-form.button-submit>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
