<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Leads</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $leads->total() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">This Week</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\ChatLead::where('created_at', '>=', now()->subWeek())->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Topics</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $topics->count() }}</p>
                </div>
            </div>

            <form method="GET" action="{{ route('leads.index') }}" class="mb-6 flex gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name, contact, or topic..."
                    class="flex-1 rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]"
                >
                <select name="topic" class="rounded-lg border-gray-300 text-sm shadow-sm focus:border-[#f05517] focus:ring-[#f05517]">
                    <option value="">All topics</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic }}" {{ request('topic') === $topic ? 'selected' : '' }}>{{ $topic }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 transition">
                    Filter
                </button>
                @if(request('search') || request('topic'))
                    <a href="{{ route('leads.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        Clear
                    </a>
                @endif
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Topic</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($leads as $lead)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $lead->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if(filter_var($lead->contact, FILTER_VALIDATE_EMAIL))
                                            <a href="mailto:{{ $lead->contact }}" class="text-[#f05517] hover:underline">{{ $lead->contact }}</a>
                                        @elseif(preg_match('/^\+?[\d\s\-()]+$/', $lead->contact))
                                            <a href="tel:{{ $lead->contact }}" class="text-[#f05517] hover:underline">{{ $lead->contact }}</a>
                                        @else
                                            {{ $lead->contact }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">
                                            {{ $lead->topic }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($lead->created_at)->diffForHumans() }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('leads.destroy', $lead) }}" class="inline" onsubmit="return confirm('Delete this lead?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">No leads yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
