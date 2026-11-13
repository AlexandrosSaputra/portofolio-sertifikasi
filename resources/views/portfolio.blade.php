<!DOCTYPE html>
<html lang="id" class="bg-ink">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portofolio Alexandros Saputra, mahasiswa Teknik Informatika dan software developer.">
    <meta name="theme-color" content="#050708">
    <title>Alexandros Saputra — Software Developer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&amp;family=Raleway:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <script>document.documentElement.classList.add('js');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-body">
    <div class="ambient-layer" aria-hidden="true"></div>

    <header class="site-header">
        <nav class="site-shell nav-shell" aria-label="Navigasi utama">
            <a href="#home" class="brand" aria-label="Kembali ke beranda">
                <span class="brand-mark">AS</span>
                <span class="brand-name">ALEXANDROS<span>.</span></span>
            </a>

            <div class="desktop-nav">
                <a data-nav-link class="nav-link is-current" href="#home">Beranda</a>
                <a data-nav-link class="nav-link" href="#about">Tentang</a>
                <a data-nav-link class="nav-link" href="#skills">Keahlian</a>
                <a data-nav-link class="nav-link" href="#projects">Proyek</a>
                <a data-nav-link class="nav-link" href="#contact">Kontak</a>
            </div>

            <div class="nav-actions">
                <span class="nav-signal" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="3.5"/><path d="M12 2.5v2M12 19.5v2M4.6 4.6 6 6M18 18l1.4 1.4M2.5 12h2M19.5 12h2M4.6 19.4 6 18M18 6l1.4-1.4"/></svg>
                </span>
                <a href="#contact" class="nav-cta">Hire Me</a>
                <button data-menu-button type="button" class="menu-button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </button>
            </div>
        </nav>

        <div id="mobile-menu" data-mobile-menu class="mobile-menu hidden">
            <div class="site-shell mobile-nav-list">
                @foreach (['home' => 'Beranda', 'about' => 'Tentang', 'skills' => 'Keahlian', 'projects' => 'Proyek', 'contact' => 'Kontak'] as $target => $label)
                    <a data-nav-link href="#{{ $target }}">{{ $label }} <span aria-hidden="true">↗</span></a>
                @endforeach
            </div>
        </div>
    </header>

    <main>
        <section id="home" class="hero-section">
            <div class="hero-grid" aria-hidden="true"></div>
            <div class="hero-aurora" aria-hidden="true"></div>
            <div class="hero-speedlines" aria-hidden="true"></div>
            <div class="hero-flowline" aria-hidden="true"></div>

            <div class="site-shell hero-layout">
                <div class="hero-copy" data-reveal>
                    <p class="quote-chip"><span aria-hidden="true">✦</span> Build with purpose, ship with precision.</p>
                    <p class="eyebrow">Halo, saya Alexandros</p>
                    <h1>
                        <span class="headline-line">Merancang</span>
                        <span class="headline-line">produk digital</span>
                        <span class="headline-line">yang <span class="accent-text">berdampak</span></span>
                    </h1>
                    <p class="hero-description">Mahasiswa Teknik Informatika dan <strong>Software Developer</strong> yang mengubah persoalan kompleks menjadi pengalaman web yang cepat, jelas, dan nyaman digunakan.</p>

                    <div class="hero-actions">
                        <a href="#projects" class="primary-button">Jelajahi proyek <span aria-hidden="true">↗</span></a>
                        <a href="#contact" class="secondary-button">Hubungi saya</a>
                    </div>

                    <dl class="identity-grid">
                        <div><dt>NBI</dt><dd>1462300235</dd></div>
                        <div><dt>Program</dt><dd>Informatika</dd></div>
                        <div><dt>Basis</dt><dd>Surabaya, ID</dd></div>
                    </dl>
                </div>

                <div class="profile-stage" data-reveal>
                    <div class="orbit-line orbit-line-one" aria-hidden="true"></div>
                    <div class="orbit-line orbit-line-two" aria-hidden="true"></div>
                    <div class="profile-frame" data-profile-card>
                        <article class="profile-card" data-profile-card-content>
                            <div class="card-techbar" aria-hidden="true"><span>AS—0235</span><span>AVAILABLE / 26</span></div>
                            <img src="{{ asset('images/profile-card.png') }}" alt="Alexandros Saputra mengenakan blazer hitam" fetchpriority="high">
                            <div class="profile-shade" aria-hidden="true"></div>
                            <div class="profile-info">
                                <div>
                                    <p>Alexandros Saputra</p>
                                    <span>Software Developer</span>
                                </div>
                                <a href="#contact" aria-label="Hubungi Alexandros">↗</a>
                            </div>
                        </article>
                    </div>
                    <div class="availability-badge"><span aria-hidden="true"></span> Terbuka untuk kolaborasi</div>
                </div>
            </div>

            <a href="#about" class="scroll-cue" aria-label="Gulir ke bagian tentang">
                <span>Scroll to explore</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
            </a>
        </section>

        <section id="about" class="content-section about-section">
            <div class="site-shell">
                <div class="section-heading" data-reveal>
                    <div><p class="eyebrow">Tentang saya</p><h2>Teknologi, desain, dan rasa ingin tahu.</h2></div>
                    <span class="section-number">01 / 04</span>
                </div>

                <div class="about-layout">
                    <div class="about-visual" data-reveal>
                        <img src="{{ asset('images/about-photo.jpg') }}" alt="Foto Alexandros Saputra" loading="lazy">
                        <div class="about-visual-label"><span>Based in</span><strong>Surabaya<br>Indonesia</strong></div>
                    </div>

                    <div class="about-copy" data-reveal>
                        <p class="lead">Saya menikmati proses mengubah ide menjadi produk digital yang terasa sederhana di permukaan, tetapi kuat di balik layar.</p>
                        <p>Fokus saya berada di persimpangan web development, kecerdasan buatan, dan UI/UX. Saya percaya kualitas lahir dari detail: struktur kode yang bersih, interaksi yang responsif, dan keputusan desain yang memiliki alasan.</p>

                        <div class="about-facts">
                            <article><span>01</span><h3>Web Development</h3><p>Antarmuka responsif dan backend Laravel yang terstruktur.</p></article>
                            <article><span>02</span><h3>Artificial Intelligence</h3><p>Eksplorasi solusi berbasis data untuk persoalan nyata.</p></article>
                            <article><span>03</span><h3>UI/UX Design</h3><p>Pengalaman yang jelas, konsisten, dan mudah dinavigasi.</p></article>
                            <article><span>04</span><h3>Continuous Learning</h3><p>Terus bereksperimen, mengukur, dan memperbaiki hasil.</p></article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="skills" class="content-section skills-section">
            <div class="site-shell">
                <div class="section-heading" data-reveal>
                    <div><p class="eyebrow">Tools & technologies</p><h2>Perangkat untuk membangun dari ujung ke ujung.</h2></div>
                    <span class="section-number">02 / 04</span>
                </div>

                @php
                    $skills = [
                        ['01', 'Frontend', 'HTML, CSS, JavaScript, Tailwind CSS, React', 'Antarmuka responsif, aksesibel, dan terasa cepat.'],
                        ['02', 'Backend', 'PHP, Laravel, CodeIgniter, MySQL', 'Logika server dan alur data yang rapi serta terukur.'],
                        ['03', 'Programming', 'Python, Java, C++, Unity', 'Algoritma, eksplorasi AI, dan pemecahan masalah.'],
                        ['04', 'Design', 'Figma, UI/UX, Prototyping', 'Dari kebutuhan pengguna menuju visual yang terarah.'],
                    ];
                @endphp

                <div class="skills-console" data-reveal>
                    <div class="console-topbar"><span>CAPABILITIES.LOG</span><span class="console-status"><i></i> SYSTEM ONLINE</span></div>
                    <div class="skill-grid">
                        @foreach ($skills as [$number, $title, $tools, $description])
                            <article class="skill-card">
                                <div class="skill-number">{{ $number }}</div>
                                <h3>{{ $title }}</h3>
                                <p class="skill-tools">{{ $tools }}</p>
                                <p>{{ $description }}</p>
                                <span class="skill-arrow" aria-hidden="true">↗</span>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

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

        <section id="contact" class="content-section contact-section">
            <div class="site-shell">
                <div class="contact-stage">
                    <div class="contact-copy" data-reveal>
                        <p class="eyebrow">Mari berkolaborasi</p>
                        <h2>Punya ide? Mari buat sesuatu yang <span class="accent-text">bermakna.</span></h2>
                        <p>Saya terbuka untuk diskusi proyek, kolaborasi, atau bertukar ide tentang teknologi dan desain.</p>
                        <div class="contact-links">
                            <a href="https://github.com/alexandrossaputra" target="_blank" rel="noopener"><span>↗</span><div><small>GitHub</small>github.com/alexandrossaputra</div></a>
                            <div><span>⌖</span><div><small>Lokasi</small>Surabaya, Indonesia</div></div>
                        </div>
                    </div>

                    <div class="contact-panel" data-reveal>
                        <div class="panel-header"><span>NEW_MESSAGE.REQUEST</span><span>SECURE / 01</span></div>
                        @if (session('success'))
                            <div class="form-alert form-success" role="status">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="form-alert form-error" role="alert">Mohon periksa kembali data yang Anda isi.</div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="form-row">
                                <div><label for="name">Nama</label><input id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required><p>@error('name'){{ $message }}@enderror</p></div>
                                <div><label for="email">Email</label><input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required><p>@error('email'){{ $message }}@enderror</p></div>
                            </div>
                            <div><label for="message">Pesan</label><textarea id="message" name="message" placeholder="Ceritakan ide atau kebutuhan Anda..." required>{{ old('message') }}</textarea><p>@error('message'){{ $message }}@enderror</p></div>
                            <button class="primary-button" type="submit">Kirim pesan <span aria-hidden="true">→</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="site-shell footer-shell">
            <a href="#home" class="brand"><span class="brand-mark">AS</span><span class="brand-name">ALEXANDROS<span>.</span></span></a>
            <p>© {{ date('Y') }} — Dibangun dengan Laravel, presisi, dan rasa ingin tahu.</p>
            <a href="#home">Kembali ke atas ↑</a>
        </div>
    </footer>
</body>
</html>
