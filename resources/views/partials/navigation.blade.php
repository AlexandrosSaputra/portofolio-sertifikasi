{{-- Label navigasi berasal dari config/portfolio.php. Markup yang sama dipakai
     desktop dan mobile agar urutan tautan selalu konsisten; JavaScript memakai
     atribut data-nav-link untuk status aktif dan menutup menu mobile. --}}

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
