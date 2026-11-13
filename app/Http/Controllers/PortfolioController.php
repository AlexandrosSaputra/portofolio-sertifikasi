<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolio', [
            'skillDomains' => $this->skillDomains(),
            'projects' => $this->projects(),
        ]);
    }

    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        Log::info('Pesan baru dari formulir portofolio diterima.', [
            'message_length' => mb_strlen($validated['message']),
        ]);

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih sudah menghubungi saya!');
    }

    /**
     * Enam bidang yang sama dipakai section Tentang dan section Keahlian.
     * Section Tentang memakai ringkasan naratif, section Keahlian memakai rincian alat.
     * Urutan array mengikuti section Tentang; `priority` menentukan urutan di section Keahlian.
     *
     * @return list<array{
     *     slug: string,
     *     title: string,
     *     status: string,
     *     tier: 'primary'|'secondary'|'tertiary',
     *     priority: int,
     *     description: string,
     *     summary: string,
     *     groups: list<array{label: string, items: list<string>}>,
     *     evidence: list<string>
     * }>
     */
    private function skillDomains(): array
    {
        return [
            [
                'slug' => 'web-developer',
                'title' => 'Web Developer',
                'status' => 'Fokus utama',
                'tier' => 'primary',
                'priority' => 1,
                'description' => 'Saya membangun aplikasi absensi, sistem informasi pegawai, dan penggajian menggunakan Laravel, CodeIgniter, PHP, serta MySQL. Saya menyukai proses menyusun alur data dan antarmuka menjadi sistem yang mudah digunakan.',
                'summary' => 'Membangun aplikasi web dari antarmuka sampai basis data, termasuk menyambungkan model bahasa lokal ke alur aplikasi.',
                'groups' => [
                    ['label' => 'Antarmuka', 'items' => ['HTML', 'CSS', 'JavaScript', 'TypeScript', 'Tailwind CSS', 'React']],
                    ['label' => 'Server', 'items' => ['PHP', 'Laravel', 'CodeIgniter', 'Node.js']],
                    ['label' => 'Data', 'items' => ['MySQL', 'PostgreSQL', 'SQLite', 'Supabase', 'Firebase']],
                    ['label' => 'Integrasi AI', 'items' => ['Ollama']],
                ],
                'evidence' => ['Pandansari System', 'NH-ZIS'],
            ],
            [
                'slug' => 'android-developer',
                'title' => 'Android Developer',
                'status' => 'Dipelajari',
                'tier' => 'tertiary',
                'priority' => 6,
                'description' => 'Saya tertarik membawa pengalaman membangun sistem informasi ke perangkat mobile. Bidang ini saya pelajari untuk memahami aplikasi yang dekat dengan aktivitas pengguna dan tetap nyaman digunakan di berbagai ukuran layar.',
                'summary' => 'Mempelajari pengembangan aplikasi mobile lintas platform agar sistem informasi tetap bisa dipakai dari perangkat pengguna.',
                'groups' => [
                    ['label' => 'Kerangka', 'items' => ['Flutter']],
                ],
                'evidence' => [],
            ],
            [
                'slug' => 'data-analyst',
                'title' => 'Data Analyst',
                'status' => 'Dikembangkan',
                'tier' => 'secondary',
                'priority' => 5,
                'description' => 'Proyek absensi, penggajian, dan pengelolaan pegawai membuat saya terbiasa melihat data sebagai dasar pengambilan keputusan. Saya menikmati proses merapikan data dan mengubahnya menjadi informasi yang lebih mudah dipahami.',
                'summary' => 'Merapikan data operasional menjadi laporan yang bisa dibaca dan dipakai sebagai dasar keputusan.',
                'groups' => [
                    ['label' => 'Alat', 'items' => ['Google Spreadsheet', 'Microsoft Excel', 'Google Looker Studio']],
                ],
                'evidence' => ['Pengadaan Barang'],
            ],
            [
                'slug' => 'machine-learning',
                'title' => 'Machine Learning',
                'status' => 'Akademik',
                'tier' => 'secondary',
                'priority' => 3,
                'description' => 'Melalui Python dan eksplorasi kecerdasan buatan, saya mempelajari bagaimana pola dalam data dapat digunakan untuk membantu menyelesaikan masalah. Fokus saya masih pada pemahaman dasar dan penerapannya secara bertahap.',
                'summary' => 'Klasifikasi supervised pada dataset kanker payudara dari Kaggle, mencapai akurasi 92% pada data uji.',
                'groups' => [
                    ['label' => 'Alat', 'items' => ['Python', 'Scikit-learn', 'Pandas', 'Matplotlib', 'Google Colab']],
                    ['label' => 'Metode', 'items' => ['ANN (MLPClassifier)', 'StandardScaler', 'One-Hot Encoding']],
                    ['label' => 'Evaluasi', 'items' => ['Confusion matrix', 'Precision', 'Recall', 'F1-score']],
                ],
                'evidence' => ['Tugas kelompok Pemelajaran Mesin, 2025'],
            ],
            [
                'slug' => 'kriptografi',
                'title' => 'Kriptografi',
                'status' => 'Riset terapan',
                'tier' => 'secondary',
                'priority' => 2,
                'description' => 'Saya tertarik pada cara sebuah sistem menjaga kerahasiaan, integritas, dan keaslian informasi. Kriptografi membantu saya melihat bahwa keamanan harus dipikirkan sejak data dibuat, disimpan, hingga dikirim.',
                'summary' => 'Tugas akhir: menganalisis performa pengamanan data teks dengan kombinasi AES dan steganografi Prediction Error pada citra digital.',
                'groups' => [
                    ['label' => 'Metode', 'items' => ['AES', 'Steganografi Prediction Error']],
                    ['label' => 'Objek', 'items' => ['Data teks', 'Citra digital']],
                    ['label' => 'Evaluasi', 'items' => ['Waktu proses', 'PSNR / MSE', 'Kapasitas penyisipan']],
                ],
                'evidence' => ['Tugas akhir'],
            ],
            [
                'slug' => 'ui-ux',
                'title' => 'UI/UX',
                'status' => 'Dikembangkan',
                'tier' => 'secondary',
                'priority' => 4,
                'description' => 'Saat mengerjakan antarmuka pengadaan barang dan portofolio ini, saya belajar menyederhanakan informasi, membangun hierarki visual, dan memperbaiki detail berdasarkan hasil yang benar-benar terlihat di layar.',
                'summary' => 'Menyusun alur dan antarmuka yang ringkas sebelum masuk ke implementasi, lalu memperbaikinya berdasarkan hasil yang terlihat di layar.',
                'groups' => [
                    ['label' => 'Alat', 'items' => ['Figma']],
                    ['label' => 'Praktik', 'items' => ['Wireframe', 'Prototyping', 'Hierarki visual']],
                ],
                'evidence' => ['Pengadaan Barang', 'Portofolio ini'],
            ],
        ];
    }

    /**
     * @return list<array{title: string, category: string, category_label: string, image: string, description: string, stack: list<string>}>
     */
    private function projects(): array
    {
        return [
            ['title' => 'Pandansari System', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-pandansari.png', 'description' => 'Sistem operasional multi-outlet dengan POS, inventori, transfer stok antar unit, dan prediksi permintaan untuk rekomendasi restock.', 'stack' => ['Laravel', 'React', 'TypeScript', 'MySQL', 'Ollama']],
            ['title' => 'NH-ZIS', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-nhzis.png', 'description' => 'Aplikasi penghimpunan ZIS untuk pengelolaan donatur, KPI fundraiser, validasi setoran, dan rekonsiliasi rekening koran.', 'stack' => ['Laravel', 'Inertia', 'React', 'TypeScript', 'Tailwind CSS']],
            ['title' => 'Absensi Pegawai', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-absensi.png', 'description' => 'Aplikasi absensi berbasis CodeIgniter 4 dengan rekap kehadiran dan laporan real-time.', 'stack' => ['CodeIgniter', 'MySQL', 'Bootstrap']],
            ['title' => 'SIM Pegawai', 'category' => 'frontend', 'category_label' => 'Frontend', 'image' => 'images/project-simpeg.png', 'description' => 'Sistem informasi pegawai dengan pengelolaan data, CRUD, dan akses multi-role.', 'stack' => ['Laravel', 'Tailwind CSS', 'MySQL']],
            ['title' => 'Penggajian Pegawai', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-penggajian.png', 'description' => 'Aplikasi penggajian otomatis dengan perhitungan tunjangan dan laporan yang terstruktur.', 'stack' => ['Laravel', 'PHP', 'MySQL']],
            ['title' => 'Pengadaan Barang', 'category' => 'design', 'category_label' => 'UI/UX', 'image' => 'images/project-pengadaan.png', 'description' => 'Antarmuka pengadaan barang yang ringkas, terhubung dengan basis data Google Spreadsheet.', 'stack' => ['HTML', 'CSS', 'JavaScript']],
        ];
    }
}
