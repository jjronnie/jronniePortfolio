@php
    $projects = [
        [
            'label' => 'Portfolio Direction',
            'title' => 'Personal brands that feel deliberate from the first scroll.',
            'summary' => 'Design systems for developers, creatives, and founders who want their online presence to feel confident and current.',
            'tags' => ['Visual direction', 'Responsive build', 'Frontend polish'],
            'details' => 'Personal portfolios that combine bold typography, smooth motion, and responsive layouts to create memorable first impressions. Each project starts with the brand personality and builds a visual system around it.',
        ],
        [
            'label' => 'Business Platforms',
            'title' => 'Company websites and Laravel experiences with clean structure.',
            'summary' => 'Modern interfaces paired with practical backend systems for bookings, dashboards, workflows, and service businesses.',
            'tags' => ['Laravel', 'UI systems', 'Scalable structure'],
            'details' => 'Full-stack Laravel applications with admin dashboards, authentication, and API integrations. The frontend is built to be as polished as the backend is dependable.',
        ],
        [
            'label' => 'Launch Support',
            'title' => 'Refinement passes that improve speed, clarity, and trust.',
            'summary' => 'Careful cleanup for aging websites that need better responsiveness, smoother motion, and stronger visual consistency.',
            'tags' => ['Optimization', 'UX cleanup', 'Frontend support'],
            'details' => 'A focused pass on performance tuning, UI bug fixing, and visual consistency. Ideal for sites that feel outdated or sluggish and need a refresh without a full rebuild.',
        ],
    ];
@endphp

<x-frontend-layout title="Work | JJUUKO RONALD">
    <section class="relative overflow-hidden bg-[#f2eadb] pt-32 sm:pt-36 lg:pt-40">
        <div class="section-shell pb-20 sm:pb-24 lg:pb-28">
            <div class="max-w-2xl">
                <p class="kicker text-black/45">Selected Work</p>
                <h1 class="mt-4 font-display text-[clamp(3rem,8vw,6.5rem)] leading-[0.9] tracking-[-0.06em] text-[#111111]">
                    Websites that feel memorable and modern.
                </h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-black/65 sm:text-lg sm:leading-8">
                    Each project is an opportunity to build something that looks refined, performs well, and
                    holds up under real content and real use.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-[#f2eadb] pb-20 text-[#111111] sm:pb-24 lg:pb-28">
        <div class="section-shell grid gap-8 lg:grid-cols-3">
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

                    <h2 class="mt-4 font-display text-3xl leading-tight tracking-[-0.04em] text-[#111111]">
                        {{ $project['title'] }}
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-black/65 sm:text-base">
                        {{ $project['summary'] }}
                    </p>

                    <p class="mt-4 text-sm leading-7 text-black/50">
                        {{ $project['details'] }}
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
    </section>

    <section class="bg-[#090909] py-20 text-white sm:py-24">
        <div class="section-shell text-center">
            <p class="kicker text-white/40">Let's Work Together</p>
            <h2 class="mt-4 font-display text-[clamp(2.4rem,5vw,4rem)] leading-[0.92] tracking-[-0.06em]">
                Have a project in mind?
            </h2>
            <p class="mt-4 text-base leading-7 text-white/60">
                I'm always open to new opportunities and collaborations.
            </p>
            <a href="{{ route('contact') }}" class="action-dark mt-8 inline-flex">
                Start a Conversation
            </a>
        </div>
    </section>
</x-frontend-layout>
