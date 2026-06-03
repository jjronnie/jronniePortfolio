<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements Feedable, HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'post_category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'featured_image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'robots',
        'schema_type',
        'reading_time_minutes',
        'status',
        'published_at',
        'updated_content_at',
        'is_featured',
        'view_count',
        'sitemap_priority',
        'sitemap_changefreq',
        'include_in_sitemap',
        'include_in_feed',
        'author_name',
        'author_url',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'updated_content_at' => 'datetime',
        'is_featured' => 'boolean',
        'include_in_sitemap' => 'boolean',
        'include_in_feed' => 'boolean',
        'view_count' => 'integer',
        'sitemap_priority' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeInSitemap(Builder $query): Builder
    {
        return $query->published()->where('include_in_sitemap', true);
    }

    public function scopeInFeed(Builder $query): Builder
    {
        return $query->published()->where('include_in_feed', true);
    }

    public function getSeoTitle(): string
    {
        return $this->meta_title ?? $this->title;
    }

    public function getSeoDescription(): string
    {
        return $this->meta_description
            ?? $this->excerpt
            ?? Str::limit(strip_tags($this->body), 155);
    }

    public function getCanonicalUrl(): string
    {
        return $this->canonical_url
            ?? route('blog.show', $this->slug);
    }

    public function getOgImage(): ?string
    {
        return $this->getOgImageUrl()
            ?? $this->og_image
            ?? $this->featured_image
            ?? asset('images/og-blog.svg');
    }

    public function getLastModified(): Carbon
    {
        return $this->updated_content_at ?? $this->updated_at;
    }

    public function getReadingTime(): int
    {
        if ($this->reading_time_minutes) {
            return (int) $this->reading_time_minutes;
        }
        $words = str_word_count(strip_tags($this->body));

        return max(1, (int) ceil($words / 200));
    }

    public static function getFeedItems(): Collection
    {
        return static::inFeed()
            ->with(['category', 'tags'])
            ->orderByDesc('published_at')
            ->limit(50)
            ->get();
    }

    public function toFeedItem(): FeedItem
    {
        $summary = preg_replace('/[^\x{0009}\x{000A}\x{000D}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $this->getSeoDescription());

        return FeedItem::create()
            ->id(route('blog.show', $this->slug))
            ->title($this->title)
            ->summary(trim($summary))
            ->updated($this->getLastModified())
            ->link(route('blog.show', $this->slug))
            ->authorName($this->author_name ?: 'Jjuuko Ronald')
            ->authorEmail('ronaldjjuuko7@gmail.com')
            ->category($this->category?->name ?? 'Development');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->singleFile()
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/avif']);

        $this->addMediaCollection('body')
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/avif', 'image/svg+xml']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(85)
            ->fit(Fit::Max, 1920, 1920)
            ->nonQueued()
            ->performOnCollections('featured', 'body');

        $this->addMediaConversion('thumb')
            ->format('webp')
            ->quality(80)
            ->fit(Fit::Crop, 400, 250)
            ->nonQueued()
            ->performOnCollections('featured');

        $this->addMediaConversion('og')
            ->format('webp')
            ->quality(85)
            ->fit(Fit::Max, 1200, 630)
            ->nonQueued()
            ->performOnCollections('featured');
    }

    public function getFeaturedUrl(?string $conversion = 'webp'): ?string
    {
        $media = $this->getFirstMedia('featured');

        return $media?->getAvailableUrl([$conversion]);
    }

    public function getOgImageUrl(): ?string
    {
        return $this->getFeaturedUrl('og');
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if ($post->status === 'published' && empty($post->published_at)) {
                $post->published_at = now();
            }
        });

        static::updating(function (Post $post) {
            if ($post->isDirty('status') && $post->status === 'published' && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
    }
}
