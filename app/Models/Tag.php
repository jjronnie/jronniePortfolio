<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function publishedPosts()
    {
        return $this->posts()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    public function getSeoTitle(): string
    {
        return $this->meta_title ?? ('#'.$this->name);
    }

    public function getSeoDescription(): string
    {
        return $this->meta_description
            ?? ('Read articles tagged '.$this->name.' by Jjuuko Ronald, full-stack developer based in Kampala, Uganda.');
    }

    protected static function booted(): void
    {
        static::creating(function (Tag $tag) {
            if (empty($tag->slug)) {
                $tag->slug = \Str::slug($tag->name);
            }
        });
    }
}
