<x-frontend-layout title="Portfolio - Web & Mobile App Projects by Jjuuko Ronald | Uganda Developer"
    meta-description="Explore real projects by Jjuuko Ronald, a Uganda-based website developer and software engineer. Web applications, mobile apps, and enterprise systems built with Laravel, React, Flutter, and more.">

    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">// Portfolio</p>
                <h2 class="section-title">Featured <span class="text-gradient">Projects</span></h2>
                <p class="section-desc">
                    A selection of featured projects - some of what I've shipped over the years.
                </p>
            </div>

            <div class="projects-featured stagger fade-in">
                @foreach ($featuredProjects as $project)
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="project-card">
                        <div class="project-card-top">
                            <span class="project-badge">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                                Featured
                            </span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="project-arrow">
                                <line x1="7" y1="17" x2="17" y2="7" />
                                <polyline points="7 7 17 7 17 17" />
                            </svg>
                        </div>
                        <p class="project-category">{{ $project->category }}</p>
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-desc">{{ $project->description }}</p>
                        <div class="project-tags">
                            @foreach ($project->tags as $tag)
                                <span class="project-tag primary">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($otherProjects->isNotEmpty())
                <div class="mt-16">
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem">More Projects</h3>
                    <div class="projects-more stagger fade-in">
                        @foreach ($otherProjects as $project)
                            <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="project-card-sm">
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
                                <p class="project-category">{{ $project->category }}</p>
                                <h4 class="project-title" style="font-size: 1.125rem">{{ $project->title }}</h4>
                                <p class="project-desc">{{ $project->description }}</p>
                                <div class="project-tags">
                                    @foreach ($project->tags as $tag)
                                        <span class="project-tag secondary">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="cta-card fade-in">
                <h3 class="cta-title">Like what you see?</h3>
                <p class="cta-desc">
                    I'm available for new builds and collaborations - let's make something exceptional.
                </p>
                <a href="/#contact" class="btn-primary">
                    Let's work together
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

</x-frontend-layout>
