<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Services\SeoService;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(protected SeoService $seo) {}

    public function index(): View
    {
        $posts = Post::published()
            ->with(['category', 'tags'])
            ->orderByDesc('published_at')
            ->paginate(12);

        $categories = PostCategory::withCount(['publishedPosts'])
            ->having('published_posts_count', '>', 0)
            ->orderBy('sort_order')
            ->get();

        $popularTags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(20)
            ->get();

        $seoData = $this->seo->blogIndexSeoData();

        return view('blog.index', compact('posts', 'categories', 'popularTags', 'seoData'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()
            ->with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('view_count');

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('post_category_id', $post->post_category_id)
                    ->orWhereHas('tags', fn ($t) => $t->whereIn('tags.id', $post->tags->pluck('id')));
            })
            ->with(['category', 'tags'])
            ->orderByDesc('published_at')
            ->limit(2)
            ->get();

        $seoData = $this->seo->postSeoData($post);

        return view('blog.show', compact('post', 'related', 'seoData'));
    }

    public function category(string $slug): View
    {
        $category = PostCategory::where('slug', $slug)->firstOrFail();

        $posts = $category->publishedPosts()
            ->paginate(12);

        $seoData = $this->seo->categorySeoData($category);

        return view('blog.index', compact('posts', 'category', 'seoData'));
    }

    public function tag(string $slug): View
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->with(['category', 'tags'])
            ->whereHas('tags', fn ($q) => $q->where('tags.slug', $slug))
            ->orderByDesc('published_at')
            ->paginate(12);

        $seoData = $this->seo->tagSeoData($tag);

        return view('blog.index', compact('posts', 'tag', 'seoData'));
    }
}
