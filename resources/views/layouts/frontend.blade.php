@props(['seoData' => null])

@php
    $currentRoute = request()->route()?->getName();
    $isHome = $currentRoute === 'home' || request()->is('/');
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
    <link rel="canonical" href="{{ url()->current() }}">

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
                    <li><a href="{{ url('/#about') }}" class="nav-link {{ $isHome ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ url('/#experience') }}" class="nav-link {{ $isHome ? 'active' : '' }}">Experience</a>
                    </li>
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
                        <li><a href="{{ url('/#about') }}" class="nav-mobile-link {{ $isHome ? 'active' : '' }}">About</a>
                        </li>
                        <li><a href="{{ url('/#experience') }}"
                                class="nav-mobile-link {{ $isHome ? 'active' : '' }}">Experience</a></li>
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
