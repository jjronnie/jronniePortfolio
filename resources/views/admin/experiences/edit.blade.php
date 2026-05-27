<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Experience / Education</h2></x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="space-y-6">
                        @csrf @method('PUT')
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                            <select name="type" id="type" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="work" @selected(old('type', $experience->type) === 'work')>Work</option>
                                <option value="education" @selected(old('type', $experience->type) === 'education')>Education</option>
                            </select>
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $experience->title) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company / Institution</label>
                            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $experience->subtitle) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium">Start Date</label>
                                <input type="text" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium">End Date</label>
                                <input type="text" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date) }}" placeholder="Present" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium">Description (for education)</label>
                            <textarea name="description" id="description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $experience->description) }}</textarea>
                        </div>
                        <div>
                            <label for="points" class="block text-sm font-medium">Points (one per line)</label>
                            <textarea name="points" id="points" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('points', $experience->points ? implode("\n", $experience->points) : '') }}</textarea>
                        </div>
                        <div>
                            <label for="tags" class="block text-sm font-medium">Tags (one per line)</label>
                            <textarea name="tags" id="tags" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('tags', $experience->tags ? implode("\n", $experience->tags) : '') }}</textarea>
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-medium">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $experience->sort_order) }}" required min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $experience->is_active)) class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="is_active" class="text-sm font-medium">Active</label>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Update</button>
                            <a href="{{ route('admin.experiences.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
