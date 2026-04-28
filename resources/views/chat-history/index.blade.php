<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="GET" action="{{ route('chat-history.index') }}" class="mb-6">
                <div class="flex gap-3">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search conversations..."
                        class="flex-1 rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]"
                    >
                    <button type="submit" class="rounded-lg bg-[#f05517] px-4 py-2 text-sm font-medium text-white hover:bg-[#d64a13] transition">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('chat-history.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Messages</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Guest ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($conversations as $conversation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('chat-history.show', $conversation->id) }}" class="hover:text-[#f05517] transition">
                                            {{ \Illuminate\Support\Str::limit($conversation->title, 60) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $conversation->message_count }}</td>
                                    <td class="px-6 py-4 text-xs text-gray-400 font-mono">{{ \Illuminate\Support\Str::limit($conversation->user_id, 12) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('chat-history.show', $conversation->id) }}" class="text-sm text-[#f05517] hover:text-[#d64a13] transition">View</a>
                                        <form method="POST" action="{{ route('chat-history.destroy', $conversation->id) }}" class="inline ml-3" onsubmit="return confirm('Delete this conversation?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">No conversations yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $conversations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
