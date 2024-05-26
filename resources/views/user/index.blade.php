<x-layouts.app>
    <div class="flex flex-col lg:flex-row h-full px-4">
        <div class="w-full p-5 bg-zinc-900 h-full lg:h-auto rounded-lg">
            <div class="flex justify-end mb-4">
                <a href="{{ route('user.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create User
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Created At</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider sr-only">Ações</th>
                    </tr>
                    </thead>
                    <tbody class="bg-zinc-800 divide-y divide-gray-700">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-100">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $user->role() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                <time datetime="{{ $user->created_at }}">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</time>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('user.edit', $user) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links('pagination::simple-tailwind') }}
            </div>
        </div>
    </div>
</x-layouts.app>
