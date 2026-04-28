<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('chat-history.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ \Illuminate\Support\Str::limit($conversation->title, 80) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center gap-6 text-xs text-gray-500">
                <span>Session: <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">{{ $conversation->user_id }}</code></span>
                <span>{{ $messages->count() }} messages</span>
                <span>{{ \Carbon\Carbon::parse($conversation->created_at)->format('M j, Y g:i A') }}</span>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-4">
                    @forelse ($messages as $message)
                        <div class="{{ $message->role === 'user' ? 'flex justify-end' : 'flex justify-start' }}">
                            <div class="max-w-[75%] rounded-2xl px-4 py-3 {{ $message->role === 'user' ? 'bg-[#f05517] text-white rounded-br-md' : 'bg-gray-100 text-gray-800 rounded-bl-md' }}">
                                <p class="text-xs font-semibold mb-1 {{ $message->role === 'user' ? 'text-white/70' : 'text-gray-400' }}">
                                    {{ $message->role === 'user' ? 'Visitor' : 'Kclich' }}
                                </p>
                                <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $message->content }}</p>
                                <p class="text-[0.65rem] mt-2 {{ $message->role === 'user' ? 'text-white/50' : 'text-gray-400' }}">
                                    {{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 text-sm py-8">No messages in this conversation.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <form method="POST" action="{{ route('chat-history.destroy', $conversation->id) }}" onsubmit="return confirm('Delete this entire conversation?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg border border-red-200 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                        Delete Conversation
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
