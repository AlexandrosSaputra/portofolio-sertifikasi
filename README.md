# Portofolio Alexandros Saputra

Portofolio pribadi berbasis Laravel 13, Blade, Tailwind CSS 4, Vite, dan JavaScript vanilla. Halaman utama terdiri dari lima bagian: Beranda, Tentang, Keahlian, Proyek, dan Kontak.

## Fitur

- Beranda dengan foto, headline, identitas singkat, dan tombol CTA.
- Tentang saya berisi latar belakang, pendidikan, dan tab bidang keahlian.
- Daftar keahlian dalam kartu responsif.
- Galeri proyek dengan filter Web App, Frontend, dan UI/UX.
- Formulir kontak dengan validasi, rate limit, flash message, dan log metadata saja.
- Navigasi responsif, animasi reveal, active section, dan dukungan reduced motion.

## Menjalankan proyek

```bash
composer install
npm install
php artisan key:generate
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Struktur utama

- `routes/web.php` — rute halaman portofolio dan pengiriman kontak.
- `app/Http/Controllers/PortfolioController.php` — data konten dan pemrosesan formulir kontak.
- `resources/views/portfolio.blade.php` — kerangka halaman utama.
- `resources/views/partials/navigation.blade.php` — navigasi desktop dan mobile.
- `resources/views/partials/footer.blade.php` — footer halaman.
- `resources/views/partials/sections/` — partial untuk setiap bagian halaman:
  - `home.blade.php`
  - `about.blade.php`
  - `skills.blade.php`
  - `projects.blade.php`
  - `contact.blade.php`
- `resources/css/app.css` — tema Tailwind dan komponen desain.
- `resources/js/app.js` — menu, filter proyek, reveal, navigasi aktif, dan rotasi keahlian.
- `tests/Feature/PortfolioPageTest.php` — pengujian tampilan dan konten halaman.
- `tests/Feature/ContactFormTest.php` — pengujian validasi, rate limit, dan log kontak.
