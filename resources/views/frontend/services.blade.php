<x-frontend-layout :seoData="$seoData">

    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">// What I Do</p>
                <h1 class="section-title">What I <span class="text-gradient">Deliver</span></h1>
                <p class="section-desc">
                    A comprehensive range of development services to bring your digital vision to life -
                    from idea to launch and beyond.
                </p>
            </div>

            <div class="services-grid stagger fade-in">
                @foreach ($coreServices as $service)
                    <a href="{{ route('service.show', $service->slug) }}" class="service-card" style="text-decoration:none">
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
                    </a>
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
                        <a href="{{ route('service.show', $service->slug) }}" class="extra-card" style="text-decoration:none">
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
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-frontend-layout>
