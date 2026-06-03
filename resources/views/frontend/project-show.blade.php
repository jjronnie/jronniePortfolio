<x-frontend-layout :seoData="$seoData">

    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container" style="max-width: 48rem">
            <div class="fade-in">
                <p class="section-eyebrow">// {{ $project->category }}</p>
                <h1 class="section-title" style="font-size:2.25rem">{{ $project->title }}</h1>
                <p class="section-desc" style="font-size:1.125rem;margin-top:1rem">
                    {{ $project->description }}
                </p>
            </div>

            @if ($project->tags)
                <div class="fade-in" style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-top:2rem">
                    @foreach ($project->tags as $tag)
                        <span class="project-tag primary">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            @if ($project->project_url)
                <div class="fade-in" style="margin-top:2.5rem;text-align:center">
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="btn-primary">
                        View Live Project
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="17" x2="17" y2="7" />
                            <polyline points="7 7 17 7 17 17" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section" style="padding-top:0">
            <div class="container">
                <div class="section-header fade-in">
                    <p class="section-eyebrow">// Related</p>
                    <h2 class="section-title">More <span class="text-gradient">Projects</span></h2>
                </div>
                <div class="projects-more stagger fade-in">
                    @foreach ($related as $r)
                        <a href="{{ route('project.show', $r->slug) }}" class="project-card-sm" style="text-decoration:none">
                            <div class="project-card-top">
                                <span class="project-folder">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                                    </svg>
                                </span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="project-arrow">
                                    <line x1="7" y1="17" x2="17" y2="7" />
                                    <polyline points="7 7 17 7 17 17" />
                                </svg>
                            </div>
                            <p class="project-category">{{ $r->category }}</p>
                            <h4 class="project-title" style="font-size:1.125rem">{{ $r->title }}</h4>
                            <p class="project-desc">{{ Str::limit($r->description, 100) }}</p>
                            <div class="project-tags">
                                @foreach ($r->tags as $t)
                                    <span class="project-tag secondary">{{ $t }}</span>
                                @endforeach
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="fade-in" style="margin-top:2rem;text-align:center">
                    <a href="{{ route('projects') }}" class="btn-secondary">&larr; All Projects</a>
                </div>
            </div>
        </section>
    @endif

</x-frontend-layout>