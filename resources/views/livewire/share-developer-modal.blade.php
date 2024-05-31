<div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed inset-0 z-50 overflow-y-auto">
    <div class="min-h-screen px-4 text-center">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div x-show="show" class="absolute inset-0 bg-zinc-800 opacity-75" x-on:click="show = false"></div>
        </div>
        <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>
        <form wire:submit="share" x-show="show" class="inline-block w-full max-w-2xl p-6 my-8 space-y-8 text-left align-middle transition-all transform bg-zinc-900 shadow-xl rounded-lg">
            <h2 class="text-lg font-medium text-zinc-100">Share Developer Profile</h2>
            <div class="mt-4 flex items-start">
                <img src="{{ $developer->avatar_url }}" alt="Avatar of {{ $developer->login }}" class="size-14 rounded-lg mr-4">
                <div>
                    <h3 class="text-lg font-semibold text-zinc-100">{{ $developer->login }}</h3>
                    <p class="text-sm text-zinc-400">{{ $developer->name }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full mb-4">
                    <x-form.select-multiple
                        wire:model="selected_users"
                    >
                        @foreach($users as $user)
                            @unless(auth()->user()->id === $user->id)
                                <option value="{{ $user->id }}">{{ $user->name }} - ({{ $user->email }})</option>
                            @endunless
                        @endforeach
                    </x-form.select-multiple>
                </div>
            </div>
            <div class="flex gap-2.5 items-center justify-end">
                <div class="mt-4">
                    <button @click="show = false" class="px-4 py-2 bg-zinc-700 text-zinc-100 rounded hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Share</button>
                </div>
            </div>
        </form>
    </div>
</div>
