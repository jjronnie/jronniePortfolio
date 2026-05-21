@php
    $processSteps = [
        [
            'number' => '01',
            'title' => 'Direction',
            'body' => 'We shape the visual mood, content priority, and structure before the interface starts taking form.',
            'details' => 'Every project begins with conversation. We clarify goals, identify the audience, and establish the visual direction. This phase sets the foundation for everything that follows, so nothing is rushed.',
        ],
        [
            'number' => '02',
            'title' => 'Build',
            'body' => 'The design is translated into responsive components, motion details, and a clean Laravel or frontend setup.',
            'details' => 'With a clear direction in place, I move into development. The interface is assembled component by component, with attention to responsiveness, performance, and code structure. You see progress as it happens.',
        ],
        [
            'number' => '03',
            'title' => 'Refine',
            'body' => 'The final pass sharpens spacing, performance, responsiveness, and the overall feeling of the experience.',
            'details' => 'Before launch, every detail gets a final review — spacing, motion, accessibility, load times, and cross-browser behaviour. The goal is a site that feels polished on every device and connection speed.',
        ],
    ];

    $highlights = [
        ['label' => 'Focus', 'value' => 'Modern websites and Laravel builds'],
        ['label' => 'Approach', 'value' => 'Design-first, code-conscious execution'],
        ['label' => 'Output', 'value' => 'Responsive, polished, launch-ready interfaces'],
        ['label' => 'Style', 'value' => 'Bold visuals with clean structure'],
    ];
@endphp

<x-frontend-layout title="Process | JJUUKO RONALD">
    <section class="relative overflow-hidden bg-[#090909] pt-32 sm:pt-36 lg:pt-40">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.04),transparent_40%)]"></div>

        <div class="section-shell relative pb-20 sm:pb-24 lg:pb-28">
            <div class="max-w-2xl">
                <p class="kicker text-white/40">Design Process</p>
                <h1 class="mt-4 font-display text-[clamp(3rem,8vw,6.5rem)] leading-[0.9] tracking-[-0.06em]">
                    A process built for clarity and quality.
                </h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-white/60 sm:text-lg sm:leading-8">
                    Three phases that keep every project focused, transparent, and delivered with the
                    attention it deserves.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-[#050505] py-20 sm:py-24 lg:py-28">
        <div class="section-shell">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
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

            <div class="mt-20 grid gap-8 lg:grid-cols-3">
                @foreach ($processSteps as $step)
                    <article class="process-card">
                        <p class="text-[0.72rem] font-semibold uppercase tracking-[0.3em] text-[#f05517]">
                            {{ $step['number'] }}
                        </p>
                        <h2 class="mt-4 font-display text-3xl leading-none tracking-[-0.04em]">
                            {{ $step['title'] }}
                        </h2>
                        <p class="mt-5 text-base leading-7 text-white/60">
                            {{ $step['body'] }}
                        </p>
                        <p class="mt-4 text-sm leading-7 text-white/40">
                            {{ $step['details'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#f05517] py-20 text-[#090909] sm:py-24">
        <div class="section-shell">
            <div class="rounded-[2rem] border border-black/15 bg-black/5 p-6 backdrop-blur-sm sm:p-8 lg:p-12">
                <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                    <div class="space-y-4">
                        <p class="kicker text-black/55">Next Step</p>
                        <h2 class="font-display text-[clamp(2.4rem,5vw,4rem)] leading-[0.92] tracking-[-0.06em]">
                            Ready to start phase one?
                        </h2>
                        <p class="max-w-xl text-base leading-7 text-black/70 sm:text-lg sm:leading-8">
                            Reach out and we'll set up a conversation to explore your project goals, timeline,
                            and how I can help bring your vision to life.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 lg:items-end">
                        <a href="{{ route('contact') }}" class="action-dark">
                            Get in Touch
                        </a>
                        <a href="{{ route('services') }}" class="action-light">
                            View Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
