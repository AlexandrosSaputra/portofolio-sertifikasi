# Portofolio Alexandros Saputra

Portofolio pribadi berbasis Laravel 13 dan Tailwind CSS 4. Desain mengadaptasi nuansa gelap, aksen biru-cyan, dan materi dari proyek PW UTS Soal 6, dengan struktur yang disesuaikan pada ketentuan tugas.

## Fitur

- Beranda dengan foto, headline, identitas singkat, dan tombol CTA.
- Tentang saya, pendidikan, fokus keahlian, dan tautan sosial.
- Daftar keahlian dalam kartu responsif.
- Galeri proyek dengan filter Web App, Frontend, dan UI/UX.
- Formulir kontak Laravel dengan validasi, rate limit, flash message, dan pencatatan ke log.
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

- `resources/views/portfolio.blade.php` — tampilan utama.
- `resources/css/app.css` — Tailwind theme dan komponen desain.
- `resources/js/app.js` — menu, filter proyek, reveal, dan navigasi aktif.
- `app/Http/Controllers/PortfolioController.php` — data proyek dan pemrosesan kontak.

# portofolio-sertifikasi
