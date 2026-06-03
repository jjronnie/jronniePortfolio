<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    public function index(): View
    {
        $categories = PostCategory::withCount('posts')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.post-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.post-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:post_categories,slug'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:320'],
        ]);

        PostCategory::create($validated);

        return to_route('admin.post-categories.index')->with('status', 'Category created successfully.');
    }

    public function edit(PostCategory $postCategory): View
    {
        return view('admin.post-categories.edit', compact('postCategory'));
    }

    public function update(Request $request, PostCategory $postCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:post_categories,slug,'.$postCategory->id],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:320'],
        ]);

        $postCategory->update($validated);

        return to_route('admin.post-categories.index')->with('status', 'Category updated successfully.');
    }

    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        if ($postCategory->posts()->exists()) {
            return to_route('admin.post-categories.index')
                ->with('status', 'Cannot delete category with existing posts. Reassign or delete the posts first.');
        }

        $postCategory->delete();

        return to_route('admin.post-categories.index')->with('status', 'Category deleted successfully.');
    }
}
