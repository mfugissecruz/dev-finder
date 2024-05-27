<div>
    <div class="flex flex-col lg:flex-row h-full px-4">
        <!-- Search Form -->
        <div class="w-full lg:w-96 p-5 bg-zinc-900 h-full lg:h-auto rounded-lg lg:fixed lg:top-20">
            <form wire:submit="search" class="space-y-3 my-6">
                <x-form.input-text wire:model="username" id="username" name="username" type="text" placeholder="Username" />
                <x-form.input-text wire:model="language" id="language" name="language" type="text" placeholder="Language" />
                <x-form.input-text wire:model="location" id="location" name="location" type="text" placeholder="Location" />
                <x-form.button-submit class="min-w-full">
                    Search
                </x-form.button-submit>

                <x-button-favorite />
            </form>
        </div>

        <!-- Developers Grid -->
        <div class="flex-1 lg:ml-96 mt-5 lg:mt-0 lg:px-5">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 xl:gap-x-8">
                @forelse($developers as $developer)
                    <livewire:developer-card :developer="$developer" wire:key="{{ $developer?->id ?? $developer?->github_id }}" />
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-xl text-zinc-500">Oppsss! No data here!</p>
                    </div>
                @endforelse
            </div>
            <x-infinite-scroll />
        </div>
    </div>
</div>
