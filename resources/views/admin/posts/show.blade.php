<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Post Details</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white">
                    Edit
                </a>
                <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">&larr; Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Content</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Title</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100 font-medium">{{ $post->title }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Slug</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100 font-mono text-sm">{{ $post->slug }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</span>
                            @php
                                $colors = ['published' => 'text-green-600 dark:text-green-400', 'draft' => 'text-yellow-600 dark:text-yellow-400', 'scheduled' => 'text-blue-600 dark:text-blue-400', 'archived' => 'text-gray-500'];
                            @endphp
                            <p class="mt-1 font-medium {{ $colors[$post->status] ?? 'text-gray-500' }}">{{ ucfirst($post->status) }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Category</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->category?->name ?? '—' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Author</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->author_name ?? '—' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Reading Time</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->reading_time_minutes ?? '—' }} min</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Published At</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->published_at?->format('M j, Y g:i A') ?? '—' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Views</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->view_count }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Updated</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->updated_at->format('M j, Y g:i A') }}</p>
                        </div>
                    </div>

                    @if ($post->tags->isNotEmpty())
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Tags</span>
                            <div class="flex gap-1.5 mt-1">
                                @foreach ($post->tags as $tag)
                                    <span class="px-2 py-0.5 text-xs rounded bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($post->excerpt)
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Excerpt</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100 text-sm">{{ $post->excerpt }}</p>
                        </div>
                    @endif

                    @if ($post->getFirstMedia('featured'))
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Featured Image</span>
                            <div class="mt-2">
                                <img src="{{ $post->getFirstMedia('featured')->getUrl('webp') }}" alt="Featured" class="max-w-sm rounded-lg shadow">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Body</h3>
                </div>
                <div class="p-6 prose prose-sm dark:prose-invert max-w-none">
                    {!! $post->body !!}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">SEO & Metadata</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Meta Title</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->meta_title ?: '(defaults to title)' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Meta Description</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100 text-sm">{{ $post->meta_description ?: '(defaults to excerpt)' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Meta Keywords</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->meta_keywords ?: '—' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Schema Type</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $post->schema_type ?? 'BlogPosting' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Robots</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100 font-mono text-sm">{{ $post->robots ?? 'index, follow' }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Canonical URL</span>
                            <p class="mt-1 text-gray-900 dark:text-gray-100 text-sm break-all">{{ $post->canonical_url ?: '(auto)' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Flags</span>
                        <span class="px-2 py-0.5 rounded {{ $post->is_featured ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">{{ $post->is_featured ? 'Featured' : 'Not featured' }}</span>
                        <span class="px-2 py-0.5 rounded {{ $post->include_in_sitemap ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">{{ $post->include_in_sitemap ? 'In Sitemap' : 'Not in sitemap' }}</span>
                        <span class="px-2 py-0.5 rounded {{ $post->include_in_feed ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">{{ $post->include_in_feed ? 'In Feed' : 'Not in feed' }}</span>
                        <span class="px-2 py-0.5 rounded {{ $post->robots === 'noindex,follow' || $post->robots === 'noindex,nofollow' ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">Sitemap priority: {{ $post->sitemap_priority ?? '0.8' }}</span>
                        <span>Sitemap freq: {{ $post->sitemap_changefreq ?? 'monthly' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
