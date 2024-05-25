<div class="container mx-auto">
    <div class="w-full flex mb-6">
        <input type="text" wire:model="username" class="h-12 flex-1 rounded-l-md border border-gray-300 focus:ring-0 focus:border-blue-500" placeholder="Username">
        <input type="text" wire:model="language" class="h-12 flex-1 rounded-l-md border border-gray-300 focus:ring-0 focus:border-blue-500" placeholder="Language">
        <input type="text" wire:model="location" class="h-12 flex-1 rounded-l-md border border-gray-300 focus:ring-0 focus:border-blue-500" placeholder="Location">
        <button wire:click="fetchDevelopers" class="h-12 px-4 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Search</button>
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10 xl:gap-x-8">
        @forelse($developers as $developer)
            <div class="group relative">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img src="{{ $developer->avatar_url }}" alt="Avatar of {{ $developer->login }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            {{ $developer->login }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">Location: {{ $developer->location }}</p>
                        <p class="mt-1 text-sm text-gray-500">Repos: {{ $developer->public_repos }}</p>
                        <p class="mt-1 text-sm text-gray-500">Followers: {{ $developer->followers }}</p>
                        <p class="mt-1 text-sm text-gray-500">Joined: {{ $developer->github_created_at }}</p>
                        <a href="{{ $developer->github_url }}" target="_blank" class="text-sm text-blue-500 hover:underline">View on GitHub</a>
                    </div>
                    <div>
                        <button wire:click="favoriteDeveloper('{{ $developer->login }}')" class="text-sm font-medium text-gray-900">
                            Favorite
                        </button>
                        <button wire:click="shareDeveloper('{{ $developer->login }}')" class="text-sm font-medium text-gray-900">
                            Share
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div>
                <p>Oppsss! No data here!</p>
            </div>
        @endforelse
    </div>
</div>
