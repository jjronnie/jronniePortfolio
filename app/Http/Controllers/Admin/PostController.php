<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['category', 'tags', 'media'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = PostCategory::orderBy('sort_order')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:220', 'unique:posts,slug'],
            'post_category_id' => ['nullable', 'integer', 'exists:post_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,scheduled,archived'],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['boolean'],
            'author_name' => ['nullable', 'string', 'max:100'],
            'schema_type' => ['nullable', 'string', 'max:50'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'sitemap_priority' => ['nullable', 'numeric', 'min:0', 'max:1'],
            'include_in_sitemap' => ['boolean'],
            'include_in_feed' => ['boolean'],
            'tags' => ['nullable', 'string'],
        ]);

        $validated['robots'] ??= 'index,follow';
        $validated['sitemap_changefreq'] ??= 'always';
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['include_in_sitemap'] = $request->boolean('include_in_sitemap', true);
        $validated['include_in_feed'] = $request->boolean('include_in_feed', true);
        $validated['reading_time_minutes'] = $this->estimateReadingTime($validated['body']);

        if (! empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::parse($validated['published_at']);
        }

        $post = Post::create($validated);

        $this->syncTags($post, $request->input('tags', ''));

        if ($request->hasFile('featured_image')) {
            $post->addMediaFromRequest('featured_image')
                ->usingFileName($post->slug.'-featured.'.$request->file('featured_image')->extension())
                ->toMediaCollection('featured');
        }

        return to_route('admin.posts.edit', $post)
            ->with('status', 'Post created successfully.');
    }

    public function show(Post $post): View
    {
        $post->load(['category', 'tags', 'media']);

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $categories = PostCategory::orderBy('sort_order')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $post->load('media');

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        // dd($request->all());

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:220', 'unique:posts,slug,'.$post->id],
            'post_category_id' => ['nullable', 'integer', 'exists:post_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,scheduled,archived'],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['boolean'],
            'author_name' => ['nullable', 'string', 'max:100'],
            'schema_type' => ['nullable', 'string', 'max:50'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'sitemap_priority' => ['nullable', 'numeric', 'min:0', 'max:1'],
            'include_in_sitemap' => ['boolean'],
            'include_in_feed' => ['boolean'],
            'tags' => ['nullable', 'string'],
        ]);

        $validated['robots'] ??= 'index,follow';
        $validated['sitemap_changefreq'] ??= 'always';
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['include_in_sitemap'] = $request->boolean('include_in_sitemap', true);
        $validated['include_in_feed'] = $request->boolean('include_in_feed', true);
        $validated['reading_time_minutes'] = $this->estimateReadingTime($validated['body']);

        if (! empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::parse($validated['published_at']);
        } elseif ($request->input('clear_published_at')) {
            $validated['published_at'] = null;
        }

        $post->update($validated);

        $this->syncTags($post, $request->input('tags', ''));

        if ($request->hasFile('featured_image')) {
            $post->clearMediaCollection('featured');
            $post->addMediaFromRequest('featured_image')
                ->usingFileName($post->slug.'-featured.'.$request->file('featured_image')->extension())
                ->toMediaCollection('featured');
        }

        if ($request->boolean('remove_featured_image')) {
            $post->clearMediaCollection('featured');
        }

        return to_route('admin.posts.index')
            ->with('status', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->clearMediaCollection('featured');
        $post->clearMediaCollection('body');
        $post->tags()->detach();
        $post->delete();

        return to_route('admin.posts.index')
            ->with('status', 'Post deleted successfully.');
    }

    protected function syncTags(Post $post, string $tagString): void
    {
        $names = array_filter(array_map('trim', explode(',', $tagString)));

        if (empty($names)) {
            $post->tags()->sync([]);

            return;
        }

        $tagIds = [];

        foreach ($names as $name) {
            $tag = Tag::firstOrCreate(
                ['slug' => \Str::slug($name)],
                ['name' => trim($name)]
            );
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);
    }

    protected function estimateReadingTime(string $body): int
    {
        $text = strip_tags($body);
        $wordCount = str_word_count($text);
        $minutes = (int) ceil($wordCount / 200);

        return max(1, $minutes);
    }
}
