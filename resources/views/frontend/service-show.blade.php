<x-frontend-layout :seoData="$seoData">

    <section class="section" style="padding-top: 7rem !important; padding-bottom: 5rem !important">
        <div class="container" style="max-width: 48rem">
            <div class="fade-in">
                <p class="section-eyebrow">// Service</p>
                <h1 class="section-title" style="font-size:2.25rem">{{ $service->title }}</h1>
                <p class="section-desc" style="font-size:1.125rem;margin-top:1rem">
                    {{ $service->description }}
                </p>
            </div>

            @if ($service->features)
                <div class="fade-in" style="margin-top:2.5rem">
                    <h2 style="font-size:1.25rem;font-weight:600;margin-bottom:1rem">What's Included</h2>
                    <ul class="service-bullets">
                        @foreach ($service->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section" style="padding-top:0">
            <div class="container">
                <div class="section-header fade-in">
                    <p class="section-eyebrow">// Related</p>
                    <h2 class="section-title">More <span class="text-gradient">Services</span></h2>
                </div>
                <div class="services-grid stagger fade-in">
                    @foreach ($related as $r)
                        <a href="{{ route('service.show', $r->slug) }}" class="service-card" style="text-decoration:none">
                            <div class="service-icon">
                                @if ($r->icon)
                                    <i data-lucide="{{ $r->icon }}" style="width:22px;height:22px"></i>
                                @else
                                    {!! $r->icon_svg !!}
                                @endif
                            </div>
                            <h3 class="service-title">{{ $r->title }}</h3>
                            <p class="service-desc">{{ Str::limit($r->description, 120) }}</p>
                        </a>
                    @endforeach
                </div>
                <div class="fade-in" style="margin-top:2rem;text-align:center">
                    <a href="{{ route('services') }}" class="btn-secondary">&larr; All Services</a>
                </div>
            </div>
        </section>
    @endif

</x-frontend-layout>