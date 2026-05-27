<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Skills</h2>
            <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                New Skill
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-800 rounded-lg text-sm text-green-600 dark:text-green-400">{{ session('status') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Order</th>
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Category</th>
                                    <th class="px-6 py-3">%</th>
                                    <th class="px-6 py-3">Active</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($skills as $skill)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4">{{ $skill->sort_order }}</td>
                                        <td class="px-6 py-4 font-medium">{{ $skill->name }}</td>
                                        <td class="px-6 py-4">{{ $skill->category }}</td>
                                        <td class="px-6 py-4">{{ $skill->percentage }}%</td>
                                        <td class="px-6 py-4">
                                            @if ($skill->is_active)
                                                <span class="text-green-600 dark:text-green-400">Yes</span>
                                            @else
                                                <span class="text-red-600 dark:text-red-400">No</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('admin.skills.edit', $skill) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline" onsubmit="return confirm('Delete this skill?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No skills found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
