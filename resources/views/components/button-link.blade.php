@props(['route', 'caption'])
<div class="flex-1">
    <div class="flex items-center justify-end">
        <a href="{{ $route }}" {{ $attributes->merge(['class' => "text-center flex items-center justify-center my-auto w-40 h-12 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-50"]) }}>
            {{ $caption }}
        </a>
    </div>
</div>
