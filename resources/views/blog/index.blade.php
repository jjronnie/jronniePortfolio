<x-frontend-layout :seoData="$seoData">
    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container">
            <div class="section-header fade-in">
                @isset($category)
                    <p class="section-eyebrow">// Category: {{ $category->name }}</p>
                    <h1 class="section-title">{{ $category->name }}</h1>
                    @if ($category->description)
                        <p class="section-desc">{{ $category->description }}</p>
                    @endif
                @elseif(isset($tag))
                    <p class="section-eyebrow">// Tagged: {{ $tag->name }}</p>
                    <h1 class="section-title">Posts tagged &ldquo;{{ $tag->name }}&rdquo;</h1>
                @else
                    <p class="section-eyebrow">// Dev Views</p>
                    <h1 class="section-title">Latest <span class="text-gradient">Articles</span></h1>
                    <p class="section-desc">
                        Thoughts on web development, mobile apps, and building
                        for the Ugandan and African tech ecosystem.
                    </p>
                @endisset
            </div>

            @if ($posts->isEmpty())
                <div class="empty-state fade-in">
                    <p>No posts yet. Check back soon!</p>
                </div>
            @else
                <div class="projects-grid stagger fade-in">
                    @foreach ($posts as $post)
                        @php
                            $imgUrl = $post->getFeaturedUrl('thumb') ?? $post->featured_image;
                            $imageLeft = $loop->even;
                        @endphp
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-horizontal {{ $imageLeft ? '' : 'image-right' }}">
                            @if ($imgUrl)
                                <div class="blog-card-image">
                                    <img src="{{ $imgUrl }}" alt="{{ $post->title }}" loading="lazy">
                                </div>
                            @endif
                            <div class="blog-card-content">
                                <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:0.5rem">
                                    @if ($post->category)
                                        <span class="tech-badge">{{ $post->category->name }}</span>
                                    @endif
                                    <span style="font-size:0.75rem;color:var(--muted-foreground);align-self:center">
                                        {{ $post->published_at?->format('M j, Y') }}
                                    </span>
                                </div>
                                <h3 class="project-title" style="font-size:1.125rem">{{ $post->title }}</h3>
                                <p class="project-desc" style="font-size:0.875rem">
                                    {{ Str::limit(strip_tags($post->body), 120) }}
                                </p>
                                @if ($post->tags->isNotEmpty())
                                    <div style="display:flex;flex-wrap:wrap;gap:0.375rem;margin-top:0.75rem">
                                        @foreach ($post->tags as $tag)
                                            <span style="font-size:0.7rem;padding:0.125rem 0.5rem;border-radius:999px;background:var(--muted);color:var(--muted-foreground)">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="pagination fade-in" style="margin-top:3rem;display:flex;justify-content:center;gap:0.5rem">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif

            @if (!isset($category) && !isset($tag))
                @php
                    $categories = $categories ?? collect();
                    $popularTags = $popularTags ?? collect();
                @endphp

                @if ($categories->isNotEmpty())
                    <div class="section-header fade-in" style="margin-top:4rem">
                        <p class="section-eyebrow">// Browse by Category</p>
                        <h2 class="section-title">Categories</h2>
                    </div>
                    <div class="extra-grid stagger fade-in">
                        @foreach ($categories as $cat)
                            <a href="{{ route('blog.category', $cat->slug) }}" class="extra-card" style="text-decoration:none">
                                <h3 style="font-size:1.125rem;font-weight:600">{{ $cat->name }}</h3>
                                @if ($cat->description)
                                    <p style="margin-top:0.375rem;font-size:0.8rem;color:var(--muted-foreground)">
                                        {{ $cat->description }}
                                    </p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($popularTags->isNotEmpty())
                    <div class="section-header fade-in" style="margin-top:4rem">
                        <p class="section-eyebrow">// Popular Topics</p>
                        <h2 class="section-title">Tags</h2>
                    </div>
                    <div class="fade-in" style="display:flex;flex-wrap:wrap;gap:0.5rem;justify-content:center">
                        @foreach ($popularTags as $t)
                            <a href="{{ route('blog.tag', $t->slug) }}" style="display:inline-block;padding:0.375rem 1rem;border-radius:999px;background:var(--muted);color:var(--foreground);text-decoration:none;font-size:0.875rem;transition:background 0.2s">
                                {{ $t->name }}
                                <span style="opacity:0.6;margin-left:0.25rem">({{ $t->posts_count }})</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-frontend-layout>
