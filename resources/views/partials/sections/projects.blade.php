<section id="projects" class="content-section projects-section">
    <div class="projects-ambient" aria-hidden="true">
        <span class="projects-ambient-glow"></span>
        <span class="projects-ambient-grid"></span>
        <span class="projects-ambient-dust"></span>
        <span class="projects-ambient-orbit projects-ambient-orbit-one"></span>
        <span class="projects-ambient-orbit projects-ambient-orbit-two"></span>
        <span class="projects-ambient-sweep"></span>
    </div>

    <div class="site-shell">
        <div class="project-showcase-meta" data-reveal>
            <p class="eyebrow">Karya pilihan</p>
            <span class="section-number">03 / 04</span>
        </div>

        @php
            $projectCount = count($projects);
        @endphp

        {{-- Kartu disusun melingkar: kartu yang posisinya melewati separuh daftar
             dipindah ke sisi seberang agar tumpukan kiri dan kanan seimbang.
             Perhitungan awal dilakukan di server supaya susunan sudah benar
             sebelum JavaScript berjalan; aturan yang sama dipakai app.js. --}}
        <div class="project-showcase" data-project-showcase role="region" aria-roledescription="carousel" aria-label="Galeri proyek">
            <div class="project-deck-stage" data-reveal>
                <div class="project-deck">
                    @foreach ($projects as $project)
                        @php
                            $position = $loop->index;

                            if ($position > $projectCount / 2) {
                                $position -= $projectCount;
                            }

                            if ($position < -$projectCount / 2) {
                                $position += $projectCount;
                            }

                            $isOffstage = abs($position) > 2;
                        @endphp

                        <button
                            type="button"
                            @class(['project-deck-card', 'is-offstage' => $isOffstage])
                            data-project-card
                            data-position="{{ $position }}"
                            data-title="{{ $project['title'] }}"
                            data-category="{{ $project['category_label'] }}"
                            data-description="{{ $project['description'] }}"
                            data-stack="{{ implode(' · ', $project['stack']) }}"
                            style="--position: {{ $position }}"
                            aria-label="Tampilkan proyek {{ $project['title'] }}"
                            @if ($loop->first) aria-current="true" @endif
                            @if ($isOffstage) inert aria-hidden="true" @endif
                        >
                            <img src="{{ asset($project['image']) }}" alt="" loading="lazy" width="1919" height="910">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="project-deck-controls" data-reveal>
                <button type="button" class="project-deck-arrow" data-project-previous aria-label="Proyek sebelumnya">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M14.5 5 7.5 12l7 7"/></svg>
                </button>
                <span class="project-deck-counter" data-project-counter>01 / {{ sprintf('%02d', $projectCount) }}</span>
                <button type="button" class="project-deck-arrow" data-project-next aria-label="Proyek berikutnya">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m9.5 5 7 7-7 7"/></svg>
                </button>
            </div>

            <p class="sr-only" data-project-status aria-live="polite" aria-atomic="true"></p>

            <div class="project-detail" data-reveal>
                <p class="project-detail-category" data-project-category>{{ $projects[0]['category_label'] }}</p>
                <h2 data-project-title>{{ $projects[0]['title'] }}</h2>
                <p class="project-detail-description" data-project-description>{{ $projects[0]['description'] }}</p>
                <p class="project-detail-stack" data-project-stack>{{ implode(' · ', $projects[0]['stack']) }}</p>
            </div>
        </div>
    </div>
</section>
