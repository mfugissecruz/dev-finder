<!-- Developers Grid -->
<div class="flex-1 container mx-auto mt-5 lg:mt-0 lg:px-5">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 xl:gap-x-8">
        @forelse($developers as $developer)
            <livewire:developer-card :developer="$developer" wire:key="{{ $developer->id }}" />
        @empty
            <div class="col-span-full text-center">
                <p class="text-xl text-zinc-500">Oppsss! No data here!</p>
            </div>
        @endforelse
    </div>
</div>
