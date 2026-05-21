@php
    $services = [
        [
            'number' => '01',
            'title' => 'Web Design',
            'description' => 'Design-led websites with strong hierarchy, polished motion, and premium presentation across devices.',
            'items' => [
                'Portfolio websites',
                'Landing pages',
                'Responsive UI systems',
                'Visual refinement',
            ],
        ],
        [
            'number' => '02',
            'title' => 'Laravel Development',
            'description' => 'Custom Laravel builds that balance frontend elegance with clean architecture and dependable delivery.',
            'items' => [
                'Custom Laravel applications',
                'Admin dashboards',
                'Authentication and roles',
                'API integrations',
            ],
        ],
        [
            'number' => '03',
            'title' => 'Optimization & Support',
            'description' => 'Performance tuning, interface cleanup, and launch support for websites that need to feel sharper.',
            'items' => [
                'Speed optimization',
                'UI bug fixing',
                'Tailwind cleanup',
                'Launch support',
            ],
        ],
    ];

    $projects = [
        [
            'label' => 'Portfolio Direction',
            'title' => 'Personal brands that feel deliberate from the first scroll.',
            'summary' => 'Design systems for developers, creatives, and founders who want their online presence to feel confident and current.',
            'tags' => ['Visual direction', 'Responsive build', 'Frontend polish'],
        ],
        [
            'label' => 'Business Platforms',
            'title' => 'Company websites and Laravel experiences with clean structure.',
            'summary' => 'Modern interfaces paired with practical backend systems for bookings, dashboards, workflows, and service businesses.',
            'tags' => ['Laravel', 'UI systems', 'Scalable structure'],
        ],
        [
            'label' => 'Launch Support',
            'title' => 'Refinement passes that improve speed, clarity, and trust.',
            'summary' => 'Careful cleanup for aging websites that need better responsiveness, smoother motion, and stronger visual consistency.',
            'tags' => ['Optimization', 'UX cleanup', 'Frontend support'],
        ],
    ];

    $processSteps = [
        [
            'number' => '01',
            'title' => 'Direction',
            'body' => 'We shape the visual mood, content priority, and structure before the interface starts taking form.',
        ],
        [
            'number' => '02',
            'title' => 'Build',
            'body' => 'The design is translated into responsive components, motion details, and a clean Laravel or frontend setup.',
        ],
        [
            'number' => '03',
            'title' => 'Refine',
            'body' => 'The final pass sharpens spacing, performance, responsiveness, and the overall feeling of the experience.',
        ],
    ];

    $highlights = [
        ['label' => 'Focus', 'value' => 'Modern websites and Laravel builds'],
        ['label' => 'Approach', 'value' => 'Design-first, code-conscious execution'],
        ['label' => 'Output', 'value' => 'Responsive, polished, launch-ready interfaces'],
        ['label' => 'Style', 'value' => 'Bold visuals with clean structure'],
    ];
@endphp

<x-frontend-layout :hide-nav="true">
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
                    href="#top"
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
                <a href="{{ route('home') }}" @click="menuOpen = false" class="menu-link">Home</a>
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

    <section id="top" class="relative min-h-screen overflow-hidden bg-[#f05517] text-[#090909]">
        <div class="hero-noise absolute inset-0 opacity-25"></div>
        <div class="hero-backdrop absolute inset-0 animate-float-slow"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,187,120,0.18),transparent_42%)]"></div>

        <div class="section-shell relative z-10 flex min-h-screen flex-col py-6 sm:py-8">
            <header class="flex items-center justify-between gap-4 animate-reveal">
                <a href="#top" class="logo-chip">
                    JR
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('contact') }}" class="hero-pill">
                        Connect With Me
                    </a>

                    <button
                        type="button"
                        @click="menuOpen = true"
                        aria-label="Open menu"
                        class="menu-button"
                    >
                        <span class="block h-px w-5 bg-current"></span>
                        <span class="block h-px w-5 bg-current"></span>
                        <span class="block h-px w-5 bg-current"></span>
                    </button>
                </div>
            </header>

            <div class="relative flex flex-1 flex-col items-center justify-center text-center">
                <p class="hero-role animate-reveal animate-reveal-delay-1">Web Developer</p>

                <h1 class="hero-name animate-reveal animate-reveal-delay-2">
                    JJUUKO RONALD
                </h1>
            </div>

            <div class="grid gap-4 pt-6 animate-reveal animate-reveal-delay-3 sm:grid-cols-3">
                <p class="hero-note text-left">Based in Uganda</p>
                <p class="hero-note text-left sm:text-center">
                    Specializing in Laravel, Web Design, & Frontend Systems
                </p>
                <p class="hero-note text-left sm:text-right">Available for Remote Projects</p>
            </div>
        </div>
    </section>

    <section id="services" class="relative overflow-hidden bg-[#070707] py-20 text-white sm:py-24 lg:py-28">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.05),transparent_40%)]"></div>

        <div class="section-shell relative">
            <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                <div class="space-y-3">
                    <p class="kicker text-white/40">Services</p>
                    <h2 class="font-display text-[clamp(2.8rem,6vw,5.2rem)] leading-[0.9] tracking-[-0.06em]">
                        Individual service blocks inspired by the black reference.
                    </h2>
                </div>

                <p class="max-w-2xl text-base leading-7 text-white/60 sm:text-lg sm:leading-8">
                    The structure stays minimal and bold: big numbering, quiet dividers, and a clearer view of
                    what I build as a web developer.
                </p>
            </div>

            <div class="mt-14 space-y-16">
                @foreach ($services as $service)
                    <article class="grid gap-8 border-t border-white/10 pt-10 xl:grid-cols-[0.72fr_1.28fr]">
                        <div class="space-y-5">
                            <p class="font-display text-[clamp(4.75rem,16vw,10rem)] leading-none tracking-[-0.08em]">
                                {{ $service['number'] }}
                            </p>

                            <div class="max-w-sm space-y-4">
                                <h3 class="font-display text-3xl leading-tight tracking-[-0.05em] sm:text-4xl">
                                    {{ $service['title'] }}
                                </h3>
                                <p class="text-base leading-7 text-white/60">
                                    {{ $service['description'] }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-0">
                            @foreach ($service['items'] as $item)
                                <div class="service-row group">
                                    <p class="text-lg text-white/88 transition duration-300 group-hover:translate-x-2 group-hover:text-white">
                                        {{ $item }}
                                    </p>
                                    <p class="text-sm font-medium uppercase tracking-[0.32em] text-white/35">
                                        {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="work" class="bg-[#f2eadb] py-20 text-[#111111] sm:py-24 lg:py-28">
        <div class="section-shell">
            <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                <div class="space-y-3">
                    <p class="kicker text-black/45">Selected Work</p>
                    <h2 class="font-display text-[clamp(2.8rem,6vw,5rem)] leading-[0.92] tracking-[-0.06em]">
                        Websites designed to feel memorable, fast, and modern.
                    </h2>
                </div>

                <p class="max-w-2xl text-base leading-7 text-black/65 sm:text-lg sm:leading-8">
                    I focus on interfaces that look refined at first glance and still hold up when real content,
                    responsiveness, and development constraints enter the picture.
                </p>
            </div>

            <div class="mt-14 grid gap-6 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="project-card group">
                        <div
                            @class([
                                'project-preview',
                                'project-preview-one' => $loop->iteration === 1,
                                'project-preview-two' => $loop->iteration === 2,
                                'project-preview-three' => $loop->iteration === 3,
                            ])
                        >
                            <div class="absolute inset-5 rounded-[1.4rem] border border-white/20"></div>
                            <div class="absolute left-6 top-6 h-24 w-24 rounded-full bg-white/15 blur-2xl"></div>
                            <div class="absolute bottom-6 right-6 h-16 w-16 rounded-full border border-white/30"></div>
                            <div class="absolute left-6 right-6 top-8 h-3 rounded-full bg-white/25"></div>
                            <div class="absolute left-6 top-16 h-24 w-[56%] rounded-[1.2rem] bg-black/20"></div>
                            <div class="absolute bottom-6 left-[48%] right-6 top-28 rounded-[1.2rem] border border-white/20 bg-white/10"></div>
                        </div>

                        <div class="mt-6 flex items-center justify-between text-[0.72rem] font-semibold uppercase tracking-[0.26em] text-black/45">
                            <span>{{ $project['label'] }}</span>
                            <span>2026</span>
                        </div>

                        <h3 class="mt-4 font-display text-3xl leading-tight tracking-[-0.04em] text-[#111111]">
                            {{ $project['title'] }}
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-black/65 sm:text-base">
                            {{ $project['summary'] }}
                        </p>

                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach ($project['tags'] as $tag)
                                <span class="inline-flex items-center rounded-full border border-black/10 px-3 py-2 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-black/60">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="process" class="bg-[#090909] py-20 text-white sm:py-24 lg:py-28">
        <div class="section-shell">
            <div class="grid gap-10 lg:grid-cols-[1fr_1fr]">
                <div class="space-y-4">
                    <p class="kicker text-white/40">Design Process</p>
                    <h2 class="font-display text-[clamp(2.8rem,6vw,5rem)] leading-[0.92] tracking-[-0.06em]">
                        A process that keeps the visual quality high without losing development clarity.
                    </h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($highlights as $highlight)
                        <article class="surface-card">
                            <p class="text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-white/35">
                                {{ $highlight['label'] }}
                            </p>
                            <p class="mt-4 font-display text-2xl leading-tight tracking-[-0.04em] text-white">
                                {{ $highlight['value'] }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-14 grid gap-6 lg:grid-cols-3">
                @foreach ($processSteps as $step)
                    <article class="process-card">
                        <p class="text-[0.72rem] font-semibold uppercase tracking-[0.3em] text-[#f05517]">
                            {{ $step['number'] }}
                        </p>
                        <h3 class="mt-4 font-display text-3xl leading-none tracking-[-0.04em]">
                            {{ $step['title'] }}
                        </h3>
                        <p class="mt-5 text-base leading-7 text-white/60">
                            {{ $step['body'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="bg-[#f05517] py-20 text-[#090909] sm:py-24">
        <div class="section-shell">
            <div class="rounded-[2rem] border border-black/15 bg-black/5 p-6 backdrop-blur-sm sm:p-8 lg:p-12">
                <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                    <div class="space-y-4">
                        <p class="kicker text-black/55">Contact</p>
                        <h2 class="font-display text-[clamp(2.8rem,6vw,5.2rem)] leading-[0.92] tracking-[-0.06em]">
                            Ready to build your next site with stronger visual presence?
                        </h2>
                        <p class="max-w-2xl text-base leading-7 text-black/70 sm:text-lg sm:leading-8">
                            From portfolio websites to Laravel products, the goal is the same: make the
                            experience feel bold, clear, and launch-ready on every screen size.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 lg:items-end">
                        <a href="{{ route('services') }}" class="action-dark">
                            View Services
                        </a>
                        <a href="{{ route('work') }}" class="action-light">
                            See Work
                        </a>
                    </div>
                </div>

                <div class="mt-10 grid gap-4 border-t border-black/15 pt-6 sm:grid-cols-3">
                    <p class="hero-note text-left">UI Design</p>
                    <p class="hero-note text-left sm:text-center">Laravel Development</p>
                    <p class="hero-note text-left sm:text-right">Responsive Frontend Systems</p>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
