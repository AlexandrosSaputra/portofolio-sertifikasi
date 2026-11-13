@php
    $navigationLinks = [
        'home' => 'Beranda',
        'about' => 'Tentang',
        'skills' => 'Keahlian',
        'projects' => 'Proyek',
        'contact' => 'Kontak',
    ];
@endphp

<header class="site-header">
    <nav class="site-shell nav-shell" aria-label="Navigasi utama">
        <a href="#home" class="brand" aria-label="AS ALEXANDROS. Kembali ke beranda">
            <span class="brand-mark">AS</span>
            <span class="brand-name">ALEXANDROS<span>.</span></span>
        </a>

        <div class="desktop-nav">
            @foreach ($navigationLinks as $target => $label)
                <a data-nav-link @class(['nav-link', 'is-current' => $loop->first]) href="#{{ $target }}">{{ $label }}</a>
            @endforeach
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
            @foreach ($navigationLinks as $target => $label)
                <a data-nav-link href="#{{ $target }}">{{ $label }} <span aria-hidden="true">↗</span></a>
            @endforeach
        </div>
    </div>
</header>
