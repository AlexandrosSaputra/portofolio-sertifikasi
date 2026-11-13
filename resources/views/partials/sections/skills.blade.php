<section id="skills" class="content-section skills-section">
    <div class="skills-ambient" aria-hidden="true">
        <span class="skills-ambient-grid"></span>
        <span class="skills-ambient-flowline"></span>
        <span class="skills-ambient-sweep"></span>
    </div>

    <div class="site-shell">
        <div class="section-heading" data-reveal>
            <div><p class="eyebrow">Bidang keahlian</p><h2>Keahlian yang saya bangun, bidang demi bidang.</h2></div>
            <span class="section-number">02 / 04</span>
        </div>

        <div class="skills-index" data-reveal>
            <span>CAPABILITIES.LOG</span>
            <span class="console-meta">{{ str_pad((string) count($skillDomains), 2, '0', STR_PAD_LEFT) }} BIDANG</span>
        </div>

        <div class="skill-grid" data-reveal>
            @foreach (collect($skillDomains)->sortBy('priority') as $skill)
                <article class="skill-tile" data-skill-domain="{{ $skill['slug'] }}" data-tier="{{ $skill['tier'] }}">
                    <div class="skill-tile-head">
                        <span class="skill-tile-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="skill-badge">{{ $skill['status'] }}</span>
                    </div>

                    <h3>{{ $skill['title'] }}</h3>
                    <p class="skill-tile-summary">{{ $skill['summary'] }}</p>

                    <dl class="skill-tile-specs">
                        @foreach ($skill['groups'] as $group)
                            <div class="skill-spec">
                                <dt>{{ $group['label'] }}</dt>
                                <dd>{{ implode(' · ', $group['items']) }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    @if ($skill['evidence'] !== [])
                        <p class="skill-tile-evidence">{{ implode(' · ', $skill['evidence']) }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
