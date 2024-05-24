<x-layouts.app>
    <div class="container mx-auto shadow-md py-8 px-6 rounded-md">
        <div class="flex justify-end">
            <a href="{{ route('user.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Create User
            </a>
        </div>

        <ul role="list" class="divide-y divide-gray-100">
            @foreach($users as $user)
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $user->name }}</p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-gray-900">{{ $user->role() }}</p>
                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Created at
                            <time datetime="{{ $user->created_at }}">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</time>
                        </p>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <a href="{{ route('user.edit', $user) }}" class="text-sm font-semibold leading-6 text-blue-600 hover:text-blue-900">Edit</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $users->links('pagination::simple-tailwind') }}
    </div>
</x-layouts.app>
