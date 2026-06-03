<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 px-4 py-3 bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-600 dark:text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Content</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The main post content and metadata.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title *</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Leave empty to auto-generate"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                            <div>
                                <label for="post_category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select name="post_category_id" id="post_category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">— No category —</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('post_category_id') == $cat->id)>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status *</label>
                                <select name="status" id="status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                                    <option value="published" @selected(old('status', 'draft') === 'published')>Published</option>
                                    <option value="scheduled" @selected(old('status', 'draft') === 'scheduled')>Scheduled</option>
                                    <option value="archived" @selected(old('status', 'draft') === 'archived')>Archived</option>
                                </select>
                            </div>
                            <div>
                                <label for="author_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                                <input type="text" name="author_name" id="author_name" value="{{ old('author_name', 'Jjuuko Ronald') }}" maxlength="100"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Published At</label>
                                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('published_at') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <x-image-upload name="featured_image" label="Featured Image" />
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" rows="2" maxlength="500"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt') }}</textarea>
                            @error('excerpt') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Body *</label>
                            <div class="mt-1">
                                <input type="hidden" name="body" id="body" value="{{ old('body') }}">
                                <trix-editor input="body" class="trix-content" style="min-height: 500px;"></trix-editor>
                            </div>
                            @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">SEO & Metadata</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Search engine optimization fields for better rankings.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" maxlength="160" placeholder="Defaults to post title"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('meta_title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="2" maxlength="320"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description') }}</textarea>
                            @error('meta_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords (comma-separated)</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" maxlength="500"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('meta_keywords') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="schema_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Schema Type</label>
                                <select name="schema_type" id="schema_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="BlogPosting" @selected(old('schema_type', 'BlogPosting') === 'BlogPosting')>BlogPosting</option>
                                    <option value="Article" @selected(old('schema_type', 'BlogPosting') === 'Article')>Article</option>
                                    <option value="TechArticle" @selected(old('schema_type', 'BlogPosting') === 'TechArticle')>TechArticle</option>
                                    <option value="NewsArticle" @selected(old('schema_type', 'BlogPosting') === 'NewsArticle')>NewsArticle</option>
                                </select>
                            </div>
                            <div>
                                <label for="sitemap_priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sitemap Priority</label>
                                <input type="number" name="sitemap_priority" id="sitemap_priority" value="{{ old('sitemap_priority', '0.8') }}" min="0" max="1" step="0.1"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div class="flex flex-wrap items-end gap-6 pb-1">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', false))
                                        class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Featured</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="include_in_sitemap" value="1" @checked(old('include_in_sitemap', true))
                                        class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">In Sitemap</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="include_in_feed" value="1" @checked(old('include_in_feed', true))
                                        class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">In Feed</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Create Post') }}</x-primary-button>
                    <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.10/dist/trix.css">
        <style>
            trix-toolbar { position: sticky; top: 0; z-index: 10; background: inherit; }
            trix-toolbar .trix-button-group { margin-bottom: 0; }
            trix-editor { min-height: 500px; max-height: 800px; overflow-y: auto; }
            trix-editor h1 { font-size: 1.75rem; font-weight: 700; line-height: 1.2; margin: 1rem 0 0.5rem; }
            trix-editor h2 { font-size: 1.5rem; font-weight: 700; line-height: 1.25; margin: 1rem 0 0.5rem; }
            trix-editor h3 { font-size: 1.25rem; font-weight: 600; line-height: 1.3; margin: 0.75rem 0 0.375rem; }
            trix-editor p { margin: 0.5rem 0; line-height: 1.7; }
            trix-editor blockquote { border-left: 3px solid var(--primary, #6366f1); padding-left: 1rem; margin: 0.75rem 0; opacity: 0.85; }
            trix-editor pre { background: #1e1e2e; color: #cdd6f4; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; font-family: 'Ubuntu Mono', monospace; font-size: 0.875rem; margin: 0.75rem 0; }
            trix-editor pre code { background: none; padding: 0; color: inherit; }
            trix-editor code { background: #f1f5f9; padding: 0.15rem 0.4rem; border-radius: 0.25rem; font-family: 'Ubuntu Mono', monospace; font-size: 0.875rem; }
            .dark trix-editor code { background: #334155; color: #e2e8f0; }
            trix-editor ul, trix-editor ol { margin: 0.5rem 0; padding-left: 1.5rem; }
            trix-editor li { margin: 0.25rem 0; }
            trix-editor a { color: var(--primary, #6366f1); text-decoration: underline; }
            trix-editor img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
            trix-editor figcaption { text-align: center; font-size: 0.8125rem; opacity: 0.7; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/trix@2.0.10/dist/trix.umd.min.js"></script>
        <script>
            document.addEventListener('trix-initialize', function () {
                const editor = document.querySelector('trix-editor');
                if (editor && editor.editor) {
                    editor.editor.loadHTML(document.getElementById('body').value || '');
                }
            });
        </script>
    @endpush
</x-app-layout>
