<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Knowledge Base') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Add New --}}
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4">Add Knowledge</h3>
                    <form method="POST" action="{{ route('knowledge.store') }}" class="space-y-4">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-[200px_1fr_auto]">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Category</label>
                                <select name="category" class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]" required>
                                    <option value="services">Services</option>
                                    <option value="projects">Projects</option>
                                    <option value="skills">Skills</option>
                                    <option value="pricing">Pricing</option>
                                    <option value="faq">FAQ</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Content</label>
                                <input type="text" name="content" placeholder="e.g. Web design starts at $500" class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]" required maxlength="5000">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="rounded-lg bg-[#f05517] px-4 py-2 text-sm font-medium text-white hover:bg-[#d64a13] transition whitespace-nowrap">
                                    Add Item
                                </button>
                            </div>
                        </div>
                        @error('content') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </form>
                </div>
            </div>

            {{-- Filter --}}
            <form method="GET" action="{{ route('knowledge.index') }}" class="mb-4 flex gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search knowledge..."
                    class="flex-1 rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]"
                >
                <select name="category" class="rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]">
                    <option value="">All categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 transition">
                    Filter
                </button>
            </form>

            {{-- Items --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Content</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Active</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Updated</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white" x-data="{ editing: null }">
                            @forelse ($items as $item)
                                <tr class="hover:bg-gray-50">
                                    {{-- View mode --}}
                                    <template x-if="editing !== {{ $item->id }}">
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">
                                                {{ ucfirst($item->category) }}
                                            </span>
                                        </td>
                                    </template>
                                    <template x-if="editing !== {{ $item->id }}">
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-md truncate">{{ $item->content }}</td>
                                    </template>
                                    <template x-if="editing !== {{ $item->id }}">
                                        <td class="px-6 py-4 text-center">
                                            <form method="POST" action="{{ route('knowledge.update', $item) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="category" value="{{ $item->category }}">
                                                <input type="hidden" name="content" value="{{ $item->content }}">
                                                <input type="hidden" name="is_active" value="{{ $item->is_active ? '0' : '1' }}">
                                                <button type="submit" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                                    {{ $item->is_active ? 'Active' : 'Off' }}
                                                </button>
                                            </form>
                                        </td>
                                    </template>
                                    <template x-if="editing !== {{ $item->id }}">
                                        <td class="px-6 py-4 text-xs text-gray-400">{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                    </template>
                                    <template x-if="editing !== {{ $item->id }}">
                                        <td class="px-6 py-4 text-right whitespace-nowrap">
                                            <button @click="editing = {{ $item->id }}" class="text-sm text-[#f05517] hover:text-[#d64a13] transition">Edit</button>
                                            <form method="POST" action="{{ route('knowledge.destroy', $item) }}" class="inline ml-3" onsubmit="return confirm('Delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 transition">Delete</button>
                                            </form>
                                        </td>
                                    </template>

                                    {{-- Edit mode --}}
                                    <template x-if="editing === {{ $item->id }}">
                                        <td colspan="5" class="px-6 py-4">
                                            <form method="POST" action="{{ route('knowledge.update', $item) }}" class="flex gap-3 items-end">
                                                @csrf
                                                @method('PATCH')
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Category</label>
                                                    <select name="category" class="rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]">
                                                        @foreach(['services','projects','skills','pricing','faq','general'] as $cat)
                                                            <option value="{{ $cat }}" {{ $item->category === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="flex-1">
                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Content</label>
                                                    <input type="text" name="content" value="{{ $item->content }}" class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]" required>
                                                </div>
                                                <input type="hidden" name="is_active" value="{{ $item->is_active }}">
                                                <button type="submit" class="rounded-lg bg-[#f05517] px-4 py-2 text-sm font-medium text-white hover:bg-[#d64a13] transition">Save</button>
                                                <button type="button" @click="editing = null" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</button>
                                            </form>
                                        </td>
                                    </template>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">
                                        No knowledge items yet. Add your first one above.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
