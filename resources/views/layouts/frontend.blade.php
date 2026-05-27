<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription ?? 'Hire Jjuuko Ronald, a professional website developer and mobile app developer in Kampala, Uganda. Expert Laravel developer, React developer, and software engineer building custom web applications, mobile apps, and enterprise systems for businesses across East Africa.' }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Jjuuko Ronald - Website Developer & Mobile App Developer in Kampala, Uganda' }}</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @unless($hideNav ?? false)
        <header class="nav-wrapper">
            <nav id="nav-bar" class="nav-bar" aria-label="Primary">
                <a href="{{ url('/') }}" class="nav-logo" aria-label="JRonnie - home">
                    <span class="nav-logo-icon">J</span>
                    <span class="nav-logo-text">JRonnie</span>
                </a>
                <ul class="nav-links">
                    <li><a href="{{ url('/#about') }}" class="nav-link">About</a></li>
                    <li><a href="{{ url('/#experience') }}" class="nav-link">Experience</a></li>
                    <li><a href="{{ url('/#skills') }}" class="nav-link">Skills</a></li>
                    <li><a href="{{ route('projects') }}" class="nav-link">Projects</a></li>
                    <li><a href="{{ route('services') }}" class="nav-link">Services</a></li>
                </ul>
                <a href="{{ url('/#contact') }}" class="nav-cta">Get in touch</a>
                <button id="mobile-btn" class="nav-mobile-btn" aria-label="Toggle menu" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>
                <div id="mobile-menu" class="nav-mobile" style="display: none">
                    <ul class="nav-mobile-links">
                        <li><a href="{{ url('/#about') }}" class="nav-mobile-link">About</a></li>
                        <li><a href="{{ url('/#experience') }}" class="nav-mobile-link">Experience</a></li>
                        <li><a href="{{ url('/#skills') }}" class="nav-mobile-link">Skills</a></li>
                        <li><a href="{{ route('projects') }}" class="nav-mobile-link">Projects</a></li>
                        <li><a href="{{ route('services') }}" class="nav-mobile-link">Services</a></li>
                        <li><a href="{{ url('/#contact') }}" class="nav-mobile-cta">Get in touch</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        @endunless

        {{ $slot }}

        <footer class="footer">
            <div class="footer-inner">
                <div class="footer-links">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('/#about') }}">About</a>
                    <a href="{{ route('projects') }}">Projects</a>
                    <a href="{{ route('services') }}">Services</a>
                    <a href="{{ url('/#contact') }}">Contact</a>
                </div>
                <p class="footer-copy">
                    &copy; {{ date('Y') }} Jjuuko Ronald. All rights reserved.
                </p>
            </div>
        </footer>

        <x-chat-widget />
    </body>
</html>
