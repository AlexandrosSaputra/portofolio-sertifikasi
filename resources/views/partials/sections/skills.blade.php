<section id="skills" class="content-section skills-section">
    <div class="site-shell">
        <div class="section-heading" data-reveal>
            <div><p class="eyebrow">Tools & technologies</p><h2>Perangkat untuk membangun dari ujung ke ujung.</h2></div>
            <span class="section-number">02 / 04</span>
        </div>

        <div class="skills-console" data-reveal>
            <div class="console-topbar"><span>CAPABILITIES.LOG</span><span class="console-status"><i></i> SYSTEM ONLINE</span></div>
            <div class="skill-grid">
                @foreach ($skills as $skill)
                    <article class="skill-card">
                        <div class="skill-number">{{ $skill['number'] }}</div>
                        <h3>{{ $skill['title'] }}</h3>
                        <p class="skill-tools">{{ $skill['tools'] }}</p>
                        <p>{{ $skill['description'] }}</p>
                        <span class="skill-arrow" aria-hidden="true">↗</span>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
