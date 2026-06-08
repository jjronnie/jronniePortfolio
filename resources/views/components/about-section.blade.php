@props(['id' => null])

<section @if($id) id="{{ $id }}" @endif {{ $attributes->merge(['class' => 'section']) }}>
    <div class="container">
        <div class="about-intro" style="display: flex; gap: 3rem; flex-wrap: wrap;">
            <div class="about-content" style="flex: 1; min-width: 280px;">
                <div class="section-header fade-in" style="max-width: 100%;">
                    <p class="section-eyebrow">01. About Me</p>
                    <h2 class="section-title">
                        Crafting digital solutions that drive real <span class="text-gradient">impact</span>
                    </h2>
                    <p class="section-desc">
                        I'm a passionate full stack developer who turns ideas into shippable web and mobile
                        products. From pixel-perfect interfaces to robust APIs, I write clean, maintainable code
                            and obsess over performance, security and user experience.
                    </p>
                </div>

                <div class="about-photo" style="position: relative; border-radius: 1.5rem; overflow: hidden; box-shadow: var(--shadow-glow); margin-top: 1.5rem;">
                    <img src="{{ asset('assets/img/jronnie-portrait.webp') }}"
                         alt="Portrait of Jjuuko Ronald, Full Stack Developer and CTO"
                         loading="lazy"
                         style="width: 100%; height: auto; display: block; border-radius: 1.5rem;" />
                </div>
            </div>
            <div class="about-cards" style="flex: 1; min-width: 280px;">
                <div class="highlights-grid stagger fade-in" style="grid-template-columns: 1fr; margin-bottom: 0;">
                    <div class="highlight-card" style="padding: 1.25rem 1.5rem;">
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
                    <div class="highlight-card" style="padding: 1.25rem 1.5rem;">
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
                    <div class="highlight-card" style="padding: 1.25rem 1.5rem;">
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
                    <div class="highlight-card" style="padding: 1.25rem 1.5rem;">
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
            </div>
        </div>

        <div class="stats-grid fade-in" style="margin-top: 3rem;">
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
