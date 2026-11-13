<section id="about" class="content-section about-section">
    <div class="site-shell">
        <div class="section-heading" data-reveal>
            <div><p class="eyebrow">Tentang saya</p><h2>Teknologi, desain, dan rasa ingin tahu.</h2></div>
            <span class="section-number">01 / 04</span>
        </div>

        <div class="about-layout" data-skill-showcase>
            <div class="about-copy" data-reveal>
                <div class="about-intro">
                    <p class="about-label">Latar Belakang</p>
                    <p class="lead">Saya menikmati proses mengubah ide menjadi produk digital yang terasa sederhana di permukaan, tetapi kuat di balik layar.</p>
                    <p>Fokus saya berada di persimpangan web development, kecerdasan buatan, dan UI/UX. Saya percaya kualitas lahir dari detail: struktur kode yang bersih, interaksi yang responsif, dan keputusan desain yang memiliki alasan.</p>
                </div>

                <div class="about-information">
                    <article class="about-education">
                        <h3>Pendidikan</h3>
                        <div class="education-list">
                            <div>
                                <strong>Universitas 17 Agustus 1945 Surabaya</strong>
                                <span>Teknik Informatika</span>
                            </div>
                            <div>
                                <strong>SMA Muhammadiyah 2 Yogyakarta</strong>
                                <span>Sekolah Menengah Atas</span>
                            </div>
                        </div>
                    </article>

                    <article class="about-interests">
                        <h3>Keterampilan &amp; Minat</h3>
                        <ul class="about-interest-list" role="tablist" aria-label="Pilih bidang informatika yang diminati">
                            @foreach ($skillDomains as $skill)
                                <li role="presentation">
                                    <button
                                        id="skill-tab-{{ $skill['slug'] }}"
                                        type="button"
                                        role="tab"
                                        class="{{ $loop->first ? 'is-active' : '' }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="skill-panel-{{ $skill['slug'] }}"
                                        tabindex="{{ $loop->first ? '0' : '-1' }}"
                                        data-skill-tab
                                    >
                                        {{ $skill['title'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </div>

            <figure class="about-visual" data-reveal>
                <div class="about-portrait">
                    <img src="{{ asset('images/about-photo.jpg') }}" alt="Foto Alexandros Saputra" loading="lazy">
                </div>
            </figure>

            <div class="about-skill-card" data-reveal>
                <div class="about-skill-card-meta">
                    <span data-skill-count>01 / 06</span>
                    <div class="about-skill-card-actions">
                        <span data-skill-status role="status">Rotasi otomatis · 5 detik</span>
                        <div class="about-skill-navigation" role="group" aria-label="Navigasi deskripsi minat">
                            <button type="button" data-skill-previous aria-label="Tampilkan minat sebelumnya">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="m14 6-6 6 6 6"/></svg>
                            </button>
                            <button type="button" data-skill-next aria-label="Tampilkan minat berikutnya">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="m10 6 6 6-6 6"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="about-skill-panels">
                    @foreach ($skillDomains as $skill)
                        <article
                            id="skill-panel-{{ $skill['slug'] }}"
                            role="tabpanel"
                            aria-labelledby="skill-tab-{{ $skill['slug'] }}"
                            data-skill-panel
                            @if (! $loop->first) hidden @endif
                        >
                            <h4>{{ $skill['title'] }}</h4>
                            <p>{{ $skill['description'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="about-skill-progress" aria-hidden="true"><span data-skill-progress></span></div>
            </div>
        </div>
    </div>
</section>
