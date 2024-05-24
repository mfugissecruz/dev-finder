@props(['action'])
<form method="POST" action="{{ $action }}" {{ $attributes }} class="container mx-auto shadow-md py-8 px-6 rounded-md">
    @csrf
    <div class="border-b border-gray-900/10 pb-12 space-y-4">
        {{ $slot }}
    </div>
</form>
