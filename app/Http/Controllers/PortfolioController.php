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
            'aboutSkills' => $this->aboutSkills(),
            'skills' => $this->skills(),
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
     * @return list<array{slug: string, title: string, description: string}>
     */
    private function aboutSkills(): array
    {
        return [
            ['slug' => 'web-developer', 'title' => 'Web Developer', 'description' => 'Saya membangun aplikasi absensi, sistem informasi pegawai, dan penggajian menggunakan Laravel, CodeIgniter, PHP, serta MySQL. Saya menyukai proses menyusun alur data dan antarmuka menjadi sistem yang mudah digunakan.'],
            ['slug' => 'android-developer', 'title' => 'Android Developer', 'description' => 'Saya tertarik membawa pengalaman membangun sistem informasi ke perangkat mobile. Bidang ini saya pelajari untuk memahami aplikasi yang dekat dengan aktivitas pengguna dan tetap nyaman digunakan di berbagai ukuran layar.'],
            ['slug' => 'data-analyst', 'title' => 'Data Analyst', 'description' => 'Proyek absensi, penggajian, dan pengelolaan pegawai membuat saya terbiasa melihat data sebagai dasar pengambilan keputusan. Saya menikmati proses merapikan data dan mengubahnya menjadi informasi yang lebih mudah dipahami.'],
            ['slug' => 'machine-learning', 'title' => 'Machine Learning', 'description' => 'Melalui Python dan eksplorasi kecerdasan buatan, saya mempelajari bagaimana pola dalam data dapat digunakan untuk membantu menyelesaikan masalah. Fokus saya masih pada pemahaman dasar dan penerapannya secara bertahap.'],
            ['slug' => 'kriptografi', 'title' => 'Kriptografi', 'description' => 'Saya tertarik pada cara sebuah sistem menjaga kerahasiaan, integritas, dan keaslian informasi. Kriptografi membantu saya melihat bahwa keamanan harus dipikirkan sejak data dibuat, disimpan, hingga dikirim.'],
            ['slug' => 'ui-ux', 'title' => 'UI/UX', 'description' => 'Saat mengerjakan antarmuka pengadaan barang dan portofolio ini, saya belajar menyederhanakan informasi, membangun hierarki visual, dan memperbaiki detail berdasarkan hasil yang benar-benar terlihat di layar.'],
        ];
    }

    /**
     * @return list<array{number: string, title: string, tools: string, description: string}>
     */
    private function skills(): array
    {
        return [
            ['number' => '01', 'title' => 'Frontend', 'tools' => 'HTML, CSS, JavaScript, Tailwind CSS, React', 'description' => 'Antarmuka responsif, aksesibel, dan terasa cepat.'],
            ['number' => '02', 'title' => 'Backend', 'tools' => 'PHP, Laravel, CodeIgniter, MySQL', 'description' => 'Logika server dan alur data yang rapi serta terukur.'],
            ['number' => '03', 'title' => 'Programming', 'tools' => 'Python, Java, C++, Unity', 'description' => 'Algoritma, eksplorasi AI, dan pemecahan masalah.'],
            ['number' => '04', 'title' => 'Design', 'tools' => 'Figma, UI/UX, Prototyping', 'description' => 'Dari kebutuhan pengguna menuju visual yang terarah.'],
        ];
    }

    /**
     * @return list<array{title: string, category: string, category_label: string, image: string, description: string, stack: list<string>}>
     */
    private function projects(): array
    {
        return [
            ['title' => 'Absensi Pegawai', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-absensi.png', 'description' => 'Aplikasi absensi berbasis CodeIgniter 4 dengan rekap kehadiran dan laporan real-time.', 'stack' => ['CodeIgniter', 'MySQL', 'Bootstrap']],
            ['title' => 'SIM Pegawai', 'category' => 'frontend', 'category_label' => 'Frontend', 'image' => 'images/project-simpeg.png', 'description' => 'Sistem informasi pegawai dengan pengelolaan data, CRUD, dan akses multi-role.', 'stack' => ['Laravel', 'Tailwind CSS', 'MySQL']],
            ['title' => 'Penggajian Pegawai', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-penggajian.png', 'description' => 'Aplikasi penggajian otomatis dengan perhitungan tunjangan dan laporan yang terstruktur.', 'stack' => ['Laravel', 'PHP', 'MySQL']],
            ['title' => 'Pengadaan Barang', 'category' => 'design', 'category_label' => 'UI/UX', 'image' => 'images/project-pengadaan.png', 'description' => 'Antarmuka pengadaan barang yang ringkas, terhubung dengan basis data Google Spreadsheet.', 'stack' => ['HTML', 'CSS', 'JavaScript']],
        ];
    }
}
