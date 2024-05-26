<div class="flex items-center justify-end">
    <a href="{{ route('favorites') }}" {{ $attributes->merge(['class' => "flex items-center justify-center gap-2 w-full h-12 px-4 bg-yellow-500 text-white font-medium rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"]) }}>
        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#ffffff" viewBox="0 0 256 256"><path d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z"></path></svg>
        <span>See Favorites</span>
    </a>
</div>
