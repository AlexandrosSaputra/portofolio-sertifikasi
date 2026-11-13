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
