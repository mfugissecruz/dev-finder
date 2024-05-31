<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#030712">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body x-cloack x-data class="bg-zinc-950 text-zinc-200 h-dvh overflow-hidden">
    <!-- Navbar -->
    @auth
        <nav id="navbar" class="bg-zinc-900 p-4 shadow-md fixed top-0 w-full transition-opacity duration-300 z-40">
            <div class="flex justify-end items-center">
                <ul class="flex space-x-3 items-center">
                    @if(auth()->user()->role === 'cto')
                        <li><a href="{{ route('dashboard') }}" class="text-zinc-300 bg-zinc-800 px-5 py-3 rounded-lg">Dashboard</a></li>
                        <li><a href="{{ route('favorites') }}" class="text-zinc-300 bg-zinc-800 px-5 py-3 rounded-lg">Favorites</a></li>
                        <li><a href="{{ route('user.index') }}" class="text-zinc-300 bg-zinc-800 px-5 py-3 rounded-lg">Users</a></li>
                    @endif
                    <li> <x-button-logout /></li>
                </ul>
            </div>
        </nav>
    @endauth

    <!-- Main Content -->
    <div class="py-20 h-full overflow-y-auto">
        <div id="loader" class="fixed inset-0 z-50 bg-zinc-800 bg-opacity-10 flex items-center justify-center hidden">
            <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-zinc-200"></div>
        </div>

        <div class="transition-opacity duration-500 opacity-0 content">
            {{ $slot }}
        </div>
    </div>
    <!-- Footer -->
    <x-footer />
</body>
</html>
