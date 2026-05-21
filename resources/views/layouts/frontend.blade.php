<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="JJUUKO RONALD is a web developer crafting modern websites and Laravel applications."
        >
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'JJUUKO RONALD | Web Developer' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=Syne:wght@700;800&family=Ubuntu:wght@400;500;700&display=swap"
            rel="stylesheet"
        >

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{ menuOpen: false }"
        @keydown.escape.window="menuOpen = false"
        :class="{ 'overflow-hidden': menuOpen }"
        class="bg-[#050505] text-white antialiased selection:bg-white selection:text-[#050505]"
    >
        <div class="relative overflow-x-clip bg-[#050505]">
            @if (!$hideNav)
                <div
                    x-cloak
                    x-show="menuOpen"
                    x-transition.opacity.duration.300ms
                    @click.self="menuOpen = false"
                    class="fixed inset-0 z-50 bg-[#050505]/95 backdrop-blur-xl"
                >
                    <div class="section-shell flex min-h-screen flex-col py-6 sm:py-8">
                        <div class="flex items-center justify-between gap-4">
                            <a
                                href="{{ url('/') }}"
                                @click="menuOpen = false"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-xs font-semibold uppercase tracking-[0.26em] text-white"
                            >
                                JR
                            </a>

                            <button
                                type="button"
                                @click="menuOpen = false"
                                class="inline-flex items-center justify-center rounded-full border border-white/10 px-4 py-2 text-[0.72rem] font-semibold uppercase tracking-[0.2em] text-white transition duration-300 hover:bg-white hover:text-[#050505]"
                            >
                                Close
                            </button>
                        </div>

                        <nav class="my-auto grid gap-4 py-12">
                            <a href="{{ url('/') }}" @click="menuOpen = false" class="menu-link">Home</a>
                            <a href="{{ route('services') }}" @click="menuOpen = false" class="menu-link">Services</a>
                            <a href="{{ route('work') }}" @click="menuOpen = false" class="menu-link">Work</a>
                            <a href="{{ route('process') }}" @click="menuOpen = false" class="menu-link">Process</a>
                            <a href="{{ route('contact') }}" @click="menuOpen = false" class="menu-link">Contact</a>
                        </nav>

                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/35">
                            JJUUKO RONALD
                        </p>
                    </div>
                </div>

                <nav class="sticky top-0 z-30 w-full bg-[#050505]/80 backdrop-blur-md">
                    <div class="section-shell flex items-center justify-between gap-4 py-4 sm:py-5">
                        <a
                            href="{{ url('/') }}"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 bg-white/[0.07] text-xs font-semibold uppercase tracking-[0.26em] text-white transition duration-300 hover:bg-white hover:text-[#050505] sm:h-11 sm:w-11"
                        >
                            JR
                        </a>

                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('contact') }}"
                                class="inline-flex items-center justify-center rounded-full border border-white/20 px-3 py-1.5 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-white transition duration-300 hover:bg-white hover:text-[#050505] sm:px-4 sm:py-2 sm:text-[0.72rem]"
                            >
                                Connect With Me
                            </a>

                            <button
                                type="button"
                                @click="menuOpen = true"
                                aria-label="Open menu"
                                class="inline-flex flex-col items-center justify-center gap-[0.18rem] rounded-full border border-white/20 p-2.5 text-white transition duration-300 hover:bg-white hover:text-[#050505] sm:gap-1 sm:p-3"
                            >
                                <span class="block h-px w-4 bg-current sm:w-5"></span>
                                <span class="block h-px w-4 bg-current sm:w-5"></span>
                                <span class="block h-px w-4 bg-current sm:w-5"></span>
                            </button>
                        </div>
                    </div>
                </nav>
            @endif

            {{ $slot }}

            <footer class="border-t border-white/5">
                <div class="section-shell py-12 sm:py-16 lg:py-20">
                    <div class="grid gap-10 lg:grid-cols-[1fr_auto] lg:items-start">
                        <div class="max-w-lg space-y-6">
                            <a
                                href="{{ url('/') }}"
                                class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/15 bg-white/[0.07] text-sm font-semibold uppercase tracking-[0.26em] text-white transition duration-300 hover:bg-white hover:text-[#050505]"
                            >
                                JR
                            </a>
                            <p class="text-sm leading-7 text-white/50">
                                Web developer crafting modern websites and Laravel applications with clean
                                structure, polished motion, and thoughtful design.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-10 sm:grid-cols-3 sm:gap-16">
                            <div class="space-y-4">
                                <p class="text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-white/30">
                                    Pages
                                </p>
                                <nav class="flex flex-col gap-2.5">
                                    <a href="{{ url('/') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Home</a>
                                    <a href="{{ route('services') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Services</a>
                                    <a href="{{ route('work') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Work</a>
                                    <a href="{{ route('process') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Process</a>
                                    <a href="{{ route('contact') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Contact</a>
                                </nav>
                            </div>

                            <div class="space-y-4">
                                <p class="text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-white/30">
                                    Services
                                </p>
                                <nav class="flex flex-col gap-2.5">
                                    <a href="{{ route('services') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Web Design</a>
                                    <a href="{{ route('services') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Laravel Development</a>
                                    <a href="{{ route('services') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Optimization & Support</a>
                                </nav>
                            </div>

                            <div class="space-y-4">
                                <p class="text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-white/30">
                                    Connect
                                </p>
                                <nav class="flex flex-col gap-2.5">
                                    <a href="{{ route('contact') }}" class="text-sm text-white/60 transition duration-300 hover:text-white">Get in Touch</a>
                                    <a href="https://github.com/jronnie" target="_blank" rel="noopener noreferrer" class="text-sm text-white/60 transition duration-300 hover:text-white">GitHub</a>
                                    <a href="https://linkedin.com/in/jronnie" target="_blank" rel="noopener noreferrer" class="text-sm text-white/60 transition duration-300 hover:text-white">LinkedIn</a>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex flex-col justify-between gap-4 border-t border-white/5 pt-6 sm:flex-row sm:items-center">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/30">
                            &copy; {{ date('Y') }} JJUUKO RONALD
                        </p>
                        <p class="text-xs text-white/25">
                            Built with Laravel &amp; Tailwind CSS
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <x-chat-widget />
    </body>
</html>
