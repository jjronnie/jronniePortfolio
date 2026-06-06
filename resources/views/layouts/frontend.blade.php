@props(['seoData' => null])

@php
    $currentRoute = request()->route()?->getName();
    $isHome = $currentRoute === 'home' || request()->is('/');
    $isAbout = $currentRoute === 'about';
    $isProjects = $currentRoute === 'projects';
    $isServices = $currentRoute === 'services' || str_starts_with((string) $currentRoute, 'service.');
    $isContact = $currentRoute === 'contact';
    $isBlog = str_starts_with((string) $currentRoute, 'blog.');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MCJ5VLNDJJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-MCJ5VLNDJJ');
    </script>

    {!! seo($seoData) !!}

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1640926658118061"
        crossorigin="anonymous"></script>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="alternate" type="application/atom+xml" title="Jjuuko Ronald Dev Blog — Atom Feed"
        href="{{ url('/feed') }}">
    <link rel="alternate" type="application/rss+xml" title="Jjuuko Ronald Dev Blog — RSS Feed"
        href="{{ url('/rss') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    @unless ($hideNav ?? false)
        <header class="nav-wrapper">
            <nav id="nav-bar" class="nav-bar" aria-label="Primary">
                <a href="{{ url('/') }}" class="nav-logo" aria-label="JRonnie - home">
                    <span class="nav-logo-icon">J</span>
                    <span class="nav-logo-text">JRonnie</span>
                </a>
                <ul class="nav-links">
                    <li><a href="{{ route('about') }}" class="nav-link {{ $isAbout ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ url('/#skills') }}" class="nav-link {{ $isHome ? 'active' : '' }}">Skills</a></li>
                    <li><a href="{{ route('projects') }}" class="nav-link {{ $isProjects ? 'active' : '' }}">Projects</a>
                    </li>
                    <li><a href="{{ route('services') }}" class="nav-link {{ $isServices ? 'active' : '' }}">Services</a>
                    </li>
                    <li><a href="{{ route('contact') }}" class="nav-link {{ $isContact ? 'active' : '' }}">Contact</a>
                    </li>
                    <li><a href="{{ route('blog.index') }}" class="nav-link {{ $isBlog ? 'active' : '' }}">Blog</a></li>
                </ul>
                <a href="{{ route('contact') }}" class="nav-cta">Get in touch</a>
                <button id="mobile-btn" class="nav-mobile-btn" aria-label="Toggle menu" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>
                <div id="mobile-menu" class="nav-mobile">
                    <ul class="nav-mobile-links">
                        <li><a href="{{ route('about') }}"
                                class="nav-mobile-link {{ $isAbout ? 'active' : '' }}">About</a>
                        </li>
                        <li><a href="{{ url('/#skills') }}"
                                class="nav-mobile-link {{ $isHome ? 'active' : '' }}">Skills</a></li>
                        <li><a href="{{ route('projects') }}"
                                class="nav-mobile-link {{ $isProjects ? 'active' : '' }}">Projects</a></li>
                        <li><a href="{{ route('services') }}"
                                class="nav-mobile-link {{ $isServices ? 'active' : '' }}">Services</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="nav-mobile-link {{ $isContact ? 'active' : '' }}">Contact</a></li>
                        <li><a href="{{ route('blog.index') }}"
                                class="nav-mobile-link {{ $isBlog ? 'active' : '' }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="nav-mobile-cta">Get in touch</a></li>
                    </ul>
                </div>
            </nav>
        </header>
    @endunless

    {{ $slot }}

    <section class="cta-section">
        <div class="container">
            <div class="cta-card fade-in">
                <h3 class="cta-title">Let's Build Something <span class="text-gradient">Amazing</span></h3>
                <p class="cta-desc">Have a project in mind? I'm available for freelance work and collaborations.</p>
                <a href="{{ route('contact') }}" class="btn-primary">
                    Start a conversation
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-col">
                    <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1.25rem">
                        <span style="width:2.25rem;height:2.25rem;display:flex;align-items:center;justify-content:center;border-radius:9999px;background:var(--primary);color:var(--primary-foreground);font-weight:700;font-size:1rem">J</span>
                        <span style="font-weight:600;font-size:1.125rem">JRonnie</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:0.75rem">
                        <a href="https://linkedin.com/in/kclich" target="_blank" rel="noreferrer" aria-label="LinkedIn" style="display:inline-flex;align-items:center;justify-content:center;width:2.5rem;height:2.5rem;border-radius:0.75rem;background:var(--bg-secondary);color:var(--text-secondary);transition:color .2s,background .2s" onmouseover="this.style.color='var(--primary)';this.style.background='color-mix(in oklab, var(--primary) 15%, transparent)'" onmouseout="this.style.color='var(--text-secondary)';this.style.background='var(--bg-secondary)'">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="https://github.com/jjronnie" target="_blank" rel="noreferrer" aria-label="GitHub" style="display:inline-flex;align-items:center;justify-content:center;width:2.5rem;height:2.5rem;border-radius:0.75rem;background:var(--bg-secondary);color:var(--text-secondary);transition:color .2s,background .2s" onmouseover="this.style.color='var(--primary)';this.style.background='color-mix(in oklab, var(--primary) 15%, transparent)'" onmouseout="this.style.color='var(--text-secondary)';this.style.background='var(--bg-secondary)'">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                            </svg>
                        </a>
                        <a href="https://x.com/kclich" target="_blank" rel="noreferrer" aria-label="X" style="display:inline-flex;align-items:center;justify-content:center;width:2.5rem;height:2.5rem;border-radius:0.75rem;background:var(--bg-secondary);color:var(--text-secondary);transition:color .2s,background .2s" onmouseover="this.style.color='var(--primary)';this.style.background='color-mix(in oklab, var(--primary) 15%, transparent)'" onmouseout="this.style.color='var(--text-secondary)';this.style.background='var(--bg-secondary)'">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Quick Links</h4>
                    <div class="footer-col-links">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/#about') }}">About</a>
                        <a href="{{ route('projects') }}">Projects</a>
                        <a href="{{ route('services') }}">Services</a>
                        <a href="{{ route('contact') }}">Contact</a>
                        <a href="{{ route('blog.index') }}">Blog</a>

                    </div>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Services</h4>
                    <div class="footer-col-links">
                        @php $serviceList = \App\Models\Service::active()->ordered()->get(); @endphp
                        @foreach ($serviceList as $s)
                            <a href="{{ route('service.show', $s->slug) }}">{{ $s->title }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">More</h4>
                    <div class="footer-col-links">

                        <a href="{{ url('/sitemap.xml') }}">Sitemap</a>
                        <a href="{{ url('/feed') }}">Feed (Atom)</a>
                        <a href="{{ url('/rss') }}">Feed (RSS)</a>
                        <a href="https://getnovas.com" target="_blank" rel="noopener">Inventory Management
                            Software</a>
                        <a href="https://techtowerinc.com" target="_blank" rel="noopener">TechTower Innovations</a>
                        <a href="https://thetechtower.com" target="_blank" rel="noopener">Tech enthusiasts</a>
                    </div>
                </div>
            </div>
            <p class="footer-copy">
                &copy; {{ date('Y') }}

                <a class="hover:underline" href="https://techtowerinc.com">TechTower Inc.</a>

                | All rights reserved.
            </p>
        </div>
    </footer>

    <x-chat-widget />

    @stack('scripts')
</body>

</html>
