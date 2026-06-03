<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'og_image',
        'sort_order',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_category_id');
    }

    public function publishedPosts()
    {
        return $this->hasMany(Post::class, 'post_category_id')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    public function getSeoTitle(): string
    {
        return $this->meta_title
            ?? ($this->name.' — Jjuuko Ronald | Laravel Developer Uganda');
    }

    public function getSeoDescription(): string
    {
        return $this->meta_description
            ?? ($this->description ?? 'Articles about '.$this->name.' by Jjuuko Ronald, full-stack developer in Uganda.');
    }

    protected static function booted(): void
    {
        static::creating(function (PostCategory $category) {
            if (empty($category->slug)) {
                $category->slug = \Str::slug($category->name);
            }
        });
    }
}
