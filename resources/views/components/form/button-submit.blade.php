<button
    type="submit"
    {{ $attributes->merge(['class' => "w-40 h-12 px-4 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50"])}}
>
    {{ $slot }}
</button>

