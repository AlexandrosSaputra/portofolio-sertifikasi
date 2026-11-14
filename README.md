# Portofolio Alexandros Saputra

Portofolio pribadi berbasis Laravel 13, Blade, Tailwind CSS 4, Vite, dan JavaScript vanilla. Satu halaman dengan lima bagian: Beranda, Tentang, Keahlian, Proyek, dan Kontak.

## Fitur

- Beranda dengan foto, headline, identitas singkat, dan tombol CTA.
- Tentang berisi latar belakang, pendidikan, dan tab bidang keahlian dengan rotasi otomatis.
- Daftar keahlian dalam grid kartu yang diurutkan berdasarkan prioritas.
- Galeri proyek berbentuk carousel kartu dengan navigasi tombol dan keyboard.
- Formulir kontak dengan validasi, rate limit, flash message, dan log metadata saja.
- Navigasi responsif, animasi reveal, penanda section aktif, dan dukungan reduced motion.

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
- `config/portfolio.php` — sumber konten statis: label navigasi, bidang keahlian, dan proyek.
- `app/Http/Controllers/PortfolioController.php` — menyiapkan data halaman dan memproses formulir kontak.
- `resources/views/portfolio.blade.php` — kerangka halaman utama.
- `resources/views/partials/navigation.blade.php` — navigasi desktop dan mobile.
- `resources/views/partials/sections/` — partial untuk setiap bagian halaman:
  - `home.blade.php`
  - `about.blade.php`
  - `skills.blade.php`
  - `projects.blade.php`
  - `contact.blade.php`
- `resources/css/app.css` — token tema, komponen desain, animasi, dan aturan responsif.
- `resources/js/app.js` — menu mobile, carousel proyek, reveal, kemiringan kartu profil, rotasi keahlian, dan penanda section aktif.
- `tests/Feature/PortfolioPageTest.php` — pengujian tampilan dan konten halaman.
- `tests/Feature/ContactFormTest.php` — pengujian validasi, rate limit, dan log kontak.

## Pemeriksaan

```bash
php artisan test
vendor/bin/pint --dirty
npm run build
```
