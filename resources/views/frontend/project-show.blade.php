<x-frontend-layout :seoData="$seoData">

    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container" style="max-width:48rem;margin:0 auto">
            <div class="fade-in">
                <p class="section-eyebrow">// {{ $project->category }}</p>
                <h1 class="section-title" style="font-size:2.25rem">{{ $project->title }}</h1>
                <div class="section-desc" style="font-size:1.125rem;margin-top:1rem;line-height:1.8">
                    @if (is_array($project->description))
                        @foreach ($project->description as $paragraph)
                            <p style="margin-bottom:1rem">{{ $paragraph }}</p>
                        @endforeach
                    @else
                        <p>{{ $project->description }}</p>
                    @endif
                </div>
            </div>

            @if ($project->skills->isNotEmpty())
                <div class="fade-in" style="margin-top:2rem">
                    <p style="font-weight:600;margin-bottom:0.75rem">Technologies Used</p>
                    <div style="display:flex;flex-wrap:wrap;gap:0.75rem">
                        @foreach ($project->skills as $skill)
                            <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.375rem 0.75rem;background:var(--bg-secondary);border-radius:999px;font-size:0.8125rem">
                                @if ($skill->icon_svg)
                                    <span style="width:1rem;height:1rem;flex-shrink:0">{!! $skill->icon_svg !!}</span>
                                @elseif ($skill->icon)
                                    <i data-lucide="{{ $skill->icon }}" style="width:1rem;height:1rem;flex-shrink:0"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        @if ($project->project_url)
            <div style="max-width:1280px;margin:2.5rem auto 0;padding:0 1.5rem">
                <div class="fade-in" style="display:flex;justify-content:flex-end">
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="btn-primary">
                        View Live Project
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="17" x2="17" y2="7" />
                            <polyline points="7 7 17 7 17 17" />
                        </svg>
                    </a>
                </div>
                <div class="fade-in" style="margin-top:1rem">
                    <div
                        x-data="{ loaded: false }"
                        x-init="setTimeout(() => loaded = true, 8000)"
                        style="position:relative;border-radius:0.75rem;overflow:hidden;background:#1a1a1a;box-shadow:0 8px 32px rgba(0,0,0,0.35)"
                    >
                        <div x-show="!loaded" x-cloak style="position:absolute;inset:0;z-index:2;background:#1a1a1a;border-radius:0.75rem">
                            <div style="padding:24px">
                                <div style="display:flex;gap:6px;margin-bottom:20px">
                                    <div style="width:10px;height:10px;border-radius:50%;background:#333" class="animate-pulse"></div>
                                    <div style="width:10px;height:10px;border-radius:50%;background:#333" class="animate-pulse"></div>
                                    <div style="width:10px;height:10px;border-radius:50%;background:#333" class="animate-pulse"></div>
                                </div>
                                <div style="height:16px;width:50%;background:#333;border-radius:4px;margin-bottom:12px" class="animate-pulse"></div>
                                <div style="height:10px;width:90%;background:#333;border-radius:4px;margin-bottom:8px" class="animate-pulse"></div>
                                <div style="height:10px;width:75%;background:#333;border-radius:4px;margin-bottom:8px" class="animate-pulse"></div>
                                <div style="height:10px;width:80%;background:#333;border-radius:4px" class="animate-pulse"></div>
                            </div>
                        </div>
                        <div style="overflow:hidden">
                            <div style="display:flex;align-items:center;gap:6px;padding:12px 16px;background:#2a2a2a;border-bottom:1px solid #333">
                                <div style="width:10px;height:10px;border-radius:50%;background:#ef4444"></div>
                                <div style="width:10px;height:10px;border-radius:50%;background:#f59e0b"></div>
                                <div style="width:10px;height:10px;border-radius:50%;background:#10b981"></div>
                            </div>
                            <iframe
                                src="{{ $project->project_url }}"
                                loading="lazy"
                                @load="loaded = true"
                                title="{{ $project->title }} preview"
                                style="width:100%;height:75vh;min-height:450px;max-height:750px;border:none;display:block;background:#fff"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">// More Work</p>
                <h2 class="section-title">Other <span class="text-gradient">Projects</span></h2>
            </div>
            @if ($otherProjects->isNotEmpty())
                <div class="projects-more stagger fade-in">
                    @foreach ($otherProjects as $p)
                        <a href="{{ route('project.show', $p->slug) }}" class="project-card-sm" style="text-decoration:none">
                            <div class="project-card-top">
                                <span class="project-folder">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                                    </svg>
                                </span>
                                @if ($p->status === 'completed')
                                    <span style="margin-left:auto;margin-right:0.5rem;font-size:0.625rem;font-weight:600;color:#16a34a">Completed</span>
                                @elseif ($p->status === 'ongoing')
                                    <span style="margin-left:auto;margin-right:0.5rem;font-size:0.625rem;font-weight:600;color:#ea580c">Ongoing</span>
                                @endif
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="project-arrow">
                                    <line x1="7" y1="17" x2="17" y2="7" />
                                    <polyline points="7 7 17 7 17 17" />
                                </svg>
                            </div>
                            <p class="project-category">{{ $p->category }}</p>
                            <h4 class="project-title" style="font-size:1.125rem">{{ $p->title }}</h4>
                            <p class="project-desc">{{ is_array($p->description) ? Str::limit($p->description[0], 100) : Str::limit($p->description, 100) }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
            <div class="fade-in" style="margin-top:2rem;text-align:center">
                <a href="{{ route('projects') }}" class="btn-secondary">View All Projects &rarr;</a>
            </div>
        </div>
    </section>

</x-frontend-layout>
