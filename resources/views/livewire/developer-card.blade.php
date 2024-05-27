<div class="group relative bg-zinc-900 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
    <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-md bg-zinc-700 lg:aspect-none group-hover:opacity-75 lg:h-72">
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
            <p class="mt-1 text-sm text-zinc-400">Joined: {{ \Carbon\Carbon::parse($developer->github_created_at)->diffForHumans() }}</p>
            <a href="{{ $developer->github_url }}" target="_blank" class="text-sm text-blue-400 hover:underline">View on GitHub</a>
        </div>
        <div class="flex space-x-2">
            @if($developer->is_favorite)
                <button wire:click="unfavorite" class="text-sm text-zinc-400 hover:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#f59e0b" viewBox="0 0 256 256"><path d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z"></path></svg>
                </button>
            @else
                <button wire:click="favorite" class="text-sm text-zinc-400 hover:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#e4e4e7" viewBox="0 0 256 256"><path d="M229.06,108.79l-48.7,42,14.88,62.79a8.4,8.4,0,0,1-12.52,9.17L128,189.09,73.28,222.74a8.4,8.4,0,0,1-12.52-9.17l14.88-62.79-48.7-42A8.46,8.46,0,0,1,31.73,94L95.64,88.8l24.62-59.6a8.36,8.36,0,0,1,15.48,0l24.62,59.6L224.27,94A8.46,8.46,0,0,1,229.06,108.79Z" opacity="0.2"></path><path d="M239.18,97.26A16.38,16.38,0,0,0,224.92,86l-59-4.76L143.14,26.15a16.36,16.36,0,0,0-30.27,0L90.11,81.23,31.08,86a16.46,16.46,0,0,0-9.37,28.86l45,38.83L53,211.75a16.38,16.38,0,0,0,24.5,17.82L128,198.49l50.53,31.08A16.4,16.4,0,0,0,203,211.75l-13.76-58.07,45-38.83A16.43,16.43,0,0,0,239.18,97.26Zm-15.34,5.47-48.7,42a8,8,0,0,0-2.56,7.91l14.88,62.8a.37.37,0,0,1-.17.48c-.18.14-.23.11-.38,0l-54.72-33.65a8,8,0,0,0-8.38,0L69.09,215.94c-.15.09-.19.12-.38,0a.37.37,0,0,1-.17-.48l14.88-62.8a8,8,0,0,0-2.56-7.91l-48.7-42c-.12-.1-.23-.19-.13-.5s.18-.27.33-.29l63.92-5.16A8,8,0,0,0,103,91.86l24.62-59.61c.08-.17.11-.25.35-.25s.27.08.35.25L153,91.86a8,8,0,0,0,6.75,4.92l63.92,5.16c.15,0,.24,0,.33.29S224,102.63,223.84,102.73Z"></path></svg>
                </button>
            @endif

            <button wire:click="shareDeveloper" class="text-sm text-zinc-400 hover:text-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#16a34a" viewBox="0 0 256 256"><path d="M237.66,117.66l-80,80A8,8,0,0,1,144,192V152.23c-57.1,3.24-96.25,40.27-107.24,52h0a12,12,0,0,1-20.68-9.58c3.71-32.26,21.38-63.29,49.76-87.37,23.57-20,52.22-32.69,78.16-34.91V32a8,8,0,0,1,13.66-5.66l80,80A8,8,0,0,1,237.66,117.66Z"></path></svg>
            </button>
        </div>
    </div>
</div>
