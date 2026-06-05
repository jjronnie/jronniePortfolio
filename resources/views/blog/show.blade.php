<x-frontend-layout :seoData="$seoData">
    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container" style="max-width: 48rem">
            <div class="fade-in">
                @if ($post->category || $post->published_at)
                    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:1rem">
                        @if ($post->category)
                            <a href="{{ route('blog.category', $post->category->slug) }}" class="tech-badge" style="text-decoration:none">{{ $post->category->name }}</a>
                        @endif
                        @if ($post->published_at)
                            <span style="font-size:0.875rem;color:var(--muted-foreground);align-self:center">
                                {{ $post->published_at->format('F j, Y') }}
                            </span>
                        @endif
                    </div>
                @endif

                <h1 style="font-size:2.25rem;font-weight:700;line-height:1.2;margin-bottom:0.5rem">{{ $post->title }}</h1>

                @if ($post->author_name)
                    <p style="color:var(--muted-foreground);margin-bottom:1.5rem">
                        By {{ $post->author_name }}
                        @if ($post->reading_time_minutes)
                            &middot; {{ $post->reading_time_minutes }} min read
                        @endif
                    </p>
                @endif

                @php $featuredUrl = $post->getFeaturedUrl('webp') ?? $post->featured_image; @endphp
                @if ($featuredUrl)
                    <div style="border-radius:0.75rem;overflow:hidden;margin-bottom:2rem">
                        <img src="{{ $featuredUrl }}" alt="{{ $post->title }}" style="width:100%;height:auto;display:block">
                    </div>
                @endif
            </div>

            <article class="prose-custom fade-in">
                {!! $post->body_with_ads !!}
            </article>

            @if ($post->tags->isNotEmpty())
                <div class="fade-in" style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--border-color)">
                    <span style="font-size:0.875rem;color:var(--muted-foreground);align-self:center">Tags:</span>
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('blog.tag', $tag->slug) }}" style="display:inline-block;padding:0.25rem 0.75rem;border-radius:999px;background:var(--muted);color:var(--foreground);text-decoration:none;font-size:0.8rem">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div>
                @include('components.adsense')
            </div>

            @if ($related->isNotEmpty())
                <div class="fade-in" style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--border-color)">
                    <h2 style="font-size:1.5rem;font-weight:600;margin-bottom:1.5rem;text-align:center">Related Articles</h2>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
                        @foreach ($related as $relatedPost)
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="project-card" style="text-decoration:none;display:flex;flex-direction:column">
                                @php $relImgUrl = $relatedPost->getFeaturedUrl('thumb') ?? $relatedPost->featured_image; @endphp
                                @if ($relImgUrl)
                                    <div class="project-img" style="background:var(--border-color);overflow:hidden;min-height:8rem">
                                        <img src="{{ $relImgUrl }}" alt="{{ $relatedPost->title }}" style="width:100%;height:100%;object-fit:cover">
                                    </div>
                                @endif
                                <div class="project-info" style="flex:1">
                                    @if ($relatedPost->category)
                                        <span class="tech-badge">{{ $relatedPost->category->name }}</span>
                                    @endif
                                    <h3 style="font-size:1rem;font-weight:600;margin-top:0.5rem">{{ $relatedPost->title }}</h3>
                                    <p style="font-size:0.85rem;color:var(--muted-foreground);margin-top:0.25rem">
                                        {{ strip_tags(Str::limit($relatedPost->body, 100)) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="fade-in" style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--border-color);text-align:center">
                <a href="{{ route('blog.index') }}" class="btn-secondary">&larr; Back to Blog</a>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        .prose-custom h2 {
            font-size: 1.625rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: var(--foreground);
            line-height: 1.3;
        }
        .prose-custom h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: var(--foreground);
            line-height: 1.35;
        }
        .prose-custom > div,
        .prose-custom p {
            margin-bottom: 1.25rem;
            font-size: 1.0625rem;
            line-height: 1.8;
            color: var(--foreground);
        }
        .prose-custom a {
            color: var(--primary);
            text-decoration: underline;
            text-underline-offset: 2px;
            transition: opacity 0.2s;
        }
        .prose-custom a:hover {
            opacity: 0.8;
        }
        .prose-custom blockquote {
            border-left: 4px solid var(--primary);
            padding: 0.75rem 1.5rem;
            margin: 1.5rem 0;
            background: var(--muted);
            border-radius: 0 0.5rem 0.5rem 0;
            font-style: italic;
            color: var(--muted-foreground);
        }
        .prose-custom ul,
        .prose-custom ol {
            margin-bottom: 1.125rem;
            padding-left: 1.5rem;
        }
        .prose-custom li {
            margin-bottom: 0.375rem;
            font-size: 1.0625rem;
            line-height: 1.7;
        }
        .prose-custom pre {
            position: relative;
            background: #1e1e2e;
            border-radius: 0.5rem;
            padding: 1rem;
            overflow-x: auto;
            margin-bottom: 1.125rem;
            font-size: 0.85rem;
            line-height: 1.6;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .prose-custom code {
            background: #1e1e2e;
            padding: 0.125rem 0.375rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
            color: #cdd6f4;
        }
        .prose-custom pre code {
            background: none;
            padding: 0;
            font-size: 0.85rem;
            color: #cdd6f4;
        }
        .prose-custom img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }
    </style>
    @endpush
</x-frontend-layout>
