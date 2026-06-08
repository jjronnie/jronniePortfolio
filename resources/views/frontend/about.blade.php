<x-frontend-layout :seoData="$seoData">
    <x-about-section style="padding-top: 7rem !important" />

    <!-- Timeline -->
    <section id="timeline" class="section">
        <div class="container">
            <div class="section-header fade-in">
                <p class="section-eyebrow">02. Timeline</p>
                <h2 class="section-title">My <span class="text-gradient">Journey</span></h2>
                <p class="section-desc">
                    A timeline of professional experience, education, and career highlights.
                </p>
            </div>

            <div class="exp-tabs fade-in">
                <button class="exp-tab active" data-value="work">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2" /><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" /></svg>
                    Work
                </button>
                <button class="exp-tab" data-value="education">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z" /><path d="M6 12v5c3 3 9 3 12 0v-5" /></svg>
                    Education
                </button>
                <button class="exp-tab" data-value="highlights">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10" /></svg>
                    Highlights
                </button>
            </div>

            <div class="exp-timeline">
                <div class="exp-timeline-line"></div>

                <div class="exp-list" data-type="work">
                    @foreach ($workExperiences as $exp)
                        <div class="exp-item">
                            <p class="exp-period-desktop">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                            <span class="exp-dot"></span>
                            <div class="exp-card">
                                <p class="exp-period-mobile">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                                <h3 class="exp-role">{{ $exp->title }}</h3>
                                <p class="exp-company">{{ $exp->subtitle }}</p>
                                @if ($exp->points)
                                    <ul class="exp-points">
                                        @foreach ($exp->points as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if ($exp->tags)
                                    <div class="exp-tags">
                                        @foreach ($exp->tags as $tag)
                                            <span class="exp-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="exp-list" data-type="education" style="display: none">
                    @foreach ($educationExperiences as $exp)
                        <div class="exp-item">
                            <p class="exp-period-desktop">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                            <span class="exp-dot"></span>
                            <div class="exp-card">
                                <p class="exp-period-mobile">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                                <h3 class="exp-role">{{ $exp->title }}</h3>
                                <p class="exp-company">{{ $exp->subtitle }}</p>
                                @if ($exp->description)
                                    <ul class="exp-points">
                                        <li>{{ $exp->description }}</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="exp-list" data-type="highlights" style="display: none">
                    @foreach ($highlights as $exp)
                        <div class="exp-item">
                            <p class="exp-period-desktop">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                            <span class="exp-dot"></span>
                            <div class="exp-card">
                                <p class="exp-period-mobile">{{ $exp->start_date }}{{ $exp->end_date ? ' - ' . $exp->end_date : '' }}</p>
                                <h3 class="exp-role">{{ $exp->title }}</h3>
                                @if ($exp->points)
                                    <ul class="exp-points">
                                        @foreach ($exp->points as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if ($exp->tags)
                                    <div class="exp-tags">
                                        @foreach ($exp->tags as $tag)
                                            <span class="exp-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
