<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="p-2 bg-red-600 text-zinc-50 transition-all duration-300 hover:bg-red-500 text-sm font-medium focus:outline-none rounded-lg">
        <span class="flex items-center justify-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fafafa" viewBox="0 0 256 256"><path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40A8,8,0,0,0,176,88v32H112a8,8,0,0,0,0,16h64v32a8,8,0,0,0,13.66,5.66l40-40A8,8,0,0,0,229.66,122.34Z"></path></svg>
            <span>Sign out</span>
        </span>
    </button>
</form>
