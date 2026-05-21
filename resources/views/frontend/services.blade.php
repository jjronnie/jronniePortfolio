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
            'details' => 'Every website starts with a clear visual direction. I focus on typography, spacing, colour, and motion to create interfaces that feel intentional and stand out across every screen size.',
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
            'details' => 'Robust backend systems built with Laravel\'s ecosystem. From authentication workflows to RESTful APIs, I deliver clean, maintainable code that scales with your project.',
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
            'details' => 'Already have a site? I can improve load times, fix layout inconsistencies, clean up Tailwind utility soup, and provide launch support so everything goes live without a hitch.',
        ],
    ];
@endphp

<x-frontend-layout title="Services | JJUUKO RONALD">
    <section class="relative overflow-hidden bg-[#070707] pt-32 sm:pt-36 lg:pt-40">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.04),transparent_40%)]"></div>

        <div class="section-shell relative pb-20 sm:pb-24 lg:pb-28">
            <div class="max-w-2xl">
                <p class="kicker text-white/40">Services</p>
                <h1 class="mt-4 font-display text-[clamp(3rem,8vw,6.5rem)] leading-[0.9] tracking-[-0.06em]">
                    What I build and how I help.
                </h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-white/60 sm:text-lg sm:leading-8">
                    From design-led frontends to full-stack Laravel systems, every project gets the same
                    attention to structure, performance, and visual quality.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-[#050505] py-20 sm:py-24 lg:py-28">
        <div class="section-shell space-y-24">
            @foreach ($services as $service)
                <article class="grid gap-10 lg:grid-cols-[1fr_1.2fr] lg:items-start">
                    <div class="space-y-6">
                        <p class="font-display text-[clamp(4rem,12vw,8rem)] leading-none tracking-[-0.08em] text-white/10">
                            {{ $service['number'] }}
                        </p>
                        <div class="space-y-4">
                            <h2 class="font-display text-3xl leading-tight tracking-[-0.05em] sm:text-4xl">
                                {{ $service['title'] }}
                            </h2>
                            <p class="text-base leading-7 text-white/60">
                                {{ $service['description'] }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <p class="text-base leading-7 text-white/70 sm:text-lg sm:leading-8">
                            {{ $service['details'] }}
                        </p>

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
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="bg-[#f05517] py-20 text-[#090909] sm:py-24">
        <div class="section-shell">
            <div class="rounded-[2rem] border border-black/15 bg-black/5 p-6 backdrop-blur-sm sm:p-8 lg:p-12">
                <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                    <div class="space-y-4">
                        <p class="kicker text-black/55">Ready to Start?</p>
                        <h2 class="font-display text-[clamp(2.4rem,5vw,4rem)] leading-[0.92] tracking-[-0.06em]">
                            Let's talk about your next project.
                        </h2>
                    </div>

                    <div class="flex flex-col gap-3 lg:items-end">
                        <a href="{{ route('work') }}" class="action-dark">
                            View Recent Work
                        </a>
                        <a href="{{ route('contact') }}" class="action-light">
                            Get in Touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
