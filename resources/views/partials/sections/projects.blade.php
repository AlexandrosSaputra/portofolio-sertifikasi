<section id="projects" class="content-section projects-section">
    <div class="site-shell">
        <div class="section-heading" data-reveal>
            <div><p class="eyebrow">Selected works</p><h2>Proyek yang dibangun untuk menyelesaikan masalah nyata.</h2></div>
            <span class="section-number">03 / 04</span>
        </div>

        <div class="project-console" data-reveal>
            <div class="project-console-head">
                <div><span class="terminal-dot"></span><span class="terminal-dot"></span><span class="terminal-dot"></span><strong>PROJECT_ARCHIVE</strong></div>
                <div class="project-filters" aria-label="Filter kategori proyek">
                    <button class="filter-button is-active" data-filter="all" aria-pressed="true">Semua</button>
                    <button class="filter-button" data-filter="web" aria-pressed="false">Web App</button>
                    <button class="filter-button" data-filter="frontend" aria-pressed="false">Frontend</button>
                    <button class="filter-button" data-filter="design" aria-pressed="false">UI/UX</button>
                </div>
            </div>

            <div class="project-grid">
                @foreach ($projects as $project)
                    <article data-project data-category="{{ $project['category'] }}" class="project-card">
                        <div class="project-image">
                            <img src="{{ asset($project['image']) }}" alt="Tampilan proyek {{ $project['title'] }}" loading="lazy">
                            <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="project-body">
                            <div class="project-meta"><span>{{ $project['category_label'] }}</span><span>2026</span></div>
                            <h3>{{ $project['title'] }}</h3>
                            <p>{{ $project['description'] }}</p>
                            <div class="project-footer">
                                <div>@foreach ($project['stack'] as $item)<span>{{ $item }}</span>@endforeach</div>
                                <a href="https://github.com/alexandrossaputra" target="_blank" rel="noopener" aria-label="Buka GitHub untuk {{ $project['title'] }}">↗</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
