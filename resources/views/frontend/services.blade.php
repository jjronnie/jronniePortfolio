<x-frontend-layout :seoData="$seoData">

    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">// What I Do</p>
                <h2 class="section-title">What I <span class="text-gradient">Deliver</span></h2>
                <p class="section-desc">
                    A comprehensive range of development services to bring your digital vision to life -
                    from idea to launch and beyond.
                </p>
            </div>

            <div class="services-grid stagger fade-in">
                @foreach ($coreServices as $service)
                    <div class="service-card">
                        <div class="service-icon">
                            @if ($service->icon)
                                <i data-lucide="{{ $service->icon }}" style="width:22px;height:22px"></i>
                            @else
                                {!! $service->icon_svg !!}
                            @endif
                        </div>
                        <h3 class="service-title">{{ $service->title }}</h3>
                        <p class="service-desc">{{ $service->description }}</p>
                        @if ($service->features)
                            <ul class="service-bullets">
                                @foreach ($service->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($beyondServices->isNotEmpty())
        <section class="section" style="padding-top: 0 !important">
            <div class="container">
                <div class="section-header fade-in">
                    <p class="section-eyebrow">// Beyond the Basics</p>
                    <h2 class="section-title">Additional <span class="text-gradient">Services</span></h2>
                </div>

                <div class="extra-grid stagger fade-in">
                    @foreach ($beyondServices as $service)
                        <div class="extra-card">
                            <div class="service-icon" style="flex-shrink: 0">
                                @if ($service->icon)
                                    <i data-lucide="{{ $service->icon }}" style="width:22px;height:22px"></i>
                                @else
                                    {!! $service->icon_svg !!}
                                @endif
                            </div>
                            <div>
                                <h3 style="font-size: 1.125rem; font-weight: 600">{{ $service->title }}</h3>
                                <p style="margin-top: 0.375rem; font-size: 0.875rem; color: var(--muted-foreground)">
                                    {{ $service->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="cta-card fade-in">
                    <h3 class="cta-title">Have a project in mind?</h3>
                    <p class="cta-desc">
                        Let's turn your idea into a polished, production-ready product your users will love.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-primary">
                        Start a conversation
                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

</x-frontend-layout>
