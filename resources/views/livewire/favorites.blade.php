<div class="container mx-auto my-10 flex flex-col lg:flex-row h-full px-4">
    <!-- Developers Grid -->
    <div class="flex-1 mt-10 lg:mt-0 lg:px-5">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 xl:gap-x-8">
            @forelse($developers as $developer)
                <div class="group relative bg-zinc-900 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="aspect-w-1 aspect-h-1  overflow-hidden rounded-md bg-zinc-700 lg:aspect-none group-hover:opacity-75 lg:h-72">
                        <img src="{{ $developer->avatar_url }}" alt="Avatar of {{ $developer->login }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                    </div>
                    <div class="mt-4 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-100">
                                {{ $developer->login }}
                            </h3>
                            <p class="mt-1 text-sm text-zinc-400">Location: {{ $developer->location }}</p>
                            <p class="mt-1 text-sm text-zinc-400">Repos: {{ $developer->public_repos }}</p>
                            <p class="mt-1 text-sm text-zinc-400">Followers: {{ $developer->followers }}</p>
                            <p class="mt-1 text-sm text-zinc-400">Joined: {{ Carbon\Carbon::parse($developer->github_created_at)->diffForHumans() }}</p>
                            <a href="{{ $developer->github_url }}" target="_blank" class="text-sm text-blue-400 hover:underline">View on GitHub</a>
                        </div>
                        <div class="flex space-x-2">
                            <button wire:click="unfavorite('{{ $developer->login }}')" class="text-sm text-zinc-400 hover:text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#f59e0b" viewBox="0 0 256 256"><path d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z"></path></svg>
                            </button>

                            <button wire:click="shareDeveloper('{{ $developer->login }}')" class="text-sm text-zinc-400 hover:text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#16a34a" viewBox="0 0 256 256"><path d="M237.66,117.66l-80,80A8,8,0,0,1,144,192V152.23c-57.1,3.24-96.25,40.27-107.24,52h0a12,12,0,0,1-20.68-9.58c3.71-32.26,21.38-63.29,49.76-87.37,23.57-20,52.22-32.69,78.16-34.91V32a8,8,0,0,1,13.66-5.66l80,80A8,8,0,0,1,237.66,117.66Z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-xl text-zinc-500">Oppsss! No data here!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
