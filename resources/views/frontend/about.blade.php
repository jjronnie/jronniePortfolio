<x-frontend-layout :seoData="$seoData">
    <!-- About -->
    <section class="section" style="padding-top: 7rem !important">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">01. About Me</p>
                <h2 class="section-title">
                    Building digital experiences that <span class="text-gradient">matter</span>
                </h2>
                <p class="section-desc">
                    I'm a passionate full stack developer who turns ideas into shippable web and mobile
                    products. From pixel-perfect interfaces to robust APIs, I write clean, maintainable code
                    and obsess over performance, security and user experience. Expert in React, Next.js,
                    Laravel, and Flutter.
                </p>
            </div>

            <div class="highlights-grid stagger fade-in">
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 16V8" />
                            <path d="m22 12-4 4V8l4 4Z" />
                            <path d="M8 8v8" />
                            <path d="m2 12 4-4v8l-4-4Z" />
                            <path d="M14 4 10 20" />
                        </svg>
                    </div>
                    <h3 class="highlight-title">Full Stack Development</h3>
                    <p class="highlight-text">
                        End-to-end web apps with React, Next.js, Node.js, Laravel and Django.
                    </p>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                            <path d="M12 18h.01" />
                        </svg>
                    </div>
                    <h3 class="highlight-title">Mobile Engineering</h3>
                    <p class="highlight-text">
                        Cross-platform Flutter apps with native-grade performance and polish.
                    </p>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z" />
                        </svg>
                    </div>
                    <h3 class="highlight-title">DevOps & Cloud</h3>
                    <p class="highlight-text">
                        CI/CD pipelines, Docker, Linux server hardening and zero-downtime deploys.
                    </p>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10" />
                        </svg>
                    </div>
                    <h3 class="highlight-title">Performance & SEO</h3>
                    <p class="highlight-text">
                        Lighthouse-tuned, search-optimized experiences that load instantly.
                    </p>
                </div>
            </div>

            <div class="stats-grid fade-in">
                <div class="stat-card">
                    <div class="stat-value">6+</div>
                    <div class="stat-label">Years Building</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">7+</div>
                    <div class="stat-label">Production Apps</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">100+</div>
                    <div class="stat-label">Businesses Digitized</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">99.9%</div>
                    <div class="stat-label">Uptime Maintained</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section id="timeline" class="section">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">02. Timeline</p>
                <h2 class="section-title">My <span class="text-gradient">Journey</span></h2>
                <p class="section-desc">
                    A timeline of professional experience, education, and career highlights.
                </p>
            </div>

            <div class="exp-tabs fade-in">
                <button class="exp-tab active" data-value="work">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2" /><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" /></svg>
                    Work
                </button>
                <button class="exp-tab" data-value="education">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z" /><path d="M6 12v5c3 3 9 3 12 0v-5" /></svg>
                    Education
                </button>
                <button class="exp-tab" data-value="highlights">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10" /></svg>
                    Highlights
                </button>
            </div>

            <div class="exp-timeline">
                <div class="exp-timeline-line"></div>

                <div class="exp-list" data-type="work">
                    @foreach ($workExperiences as $exp)
                        <div class="exp-item">
                            <p class="exp-period-desktop">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                            <span class="exp-dot"></span>
                            <div class="exp-card">
                                <p class="exp-period-mobile">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                                <h3 class="exp-role">{{ $exp->title }}</h3>
                                <p class="exp-company">{{ $exp->subtitle }}</p>
                                @if ($exp->points)
                                    <ul class="exp-points">
                                        @foreach ($exp->points as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if ($exp->tags)
                                    <div class="exp-tags">
                                        @foreach ($exp->tags as $tag)
                                            <span class="exp-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="exp-list" data-type="education" style="display: none">
                    @foreach ($educationExperiences as $exp)
                        <div class="exp-item">
                            <p class="exp-period-desktop">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                            <span class="exp-dot"></span>
                            <div class="exp-card">
                                <p class="exp-period-mobile">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                                <h3 class="exp-role">{{ $exp->title }}</h3>
                                <p class="exp-company">{{ $exp->subtitle }}</p>
                                @if ($exp->description)
                                    <ul class="exp-points">
                                        <li>{{ $exp->description }}</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="exp-list" data-type="highlights" style="display: none">
                    @foreach ($highlights as $exp)
                        <div class="exp-item">
                            <p class="exp-period-desktop">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                            <span class="exp-dot"></span>
                            <div class="exp-card">
                                <p class="exp-period-mobile">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                                <h3 class="exp-role">{{ $exp->title }}</h3>
                                @if ($exp->points)
                                    <ul class="exp-points">
                                        @foreach ($exp->points as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if ($exp->tags)
                                    <div class="exp-tags">
                                        @foreach ($exp->tags as $tag)
                                            <span class="exp-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
