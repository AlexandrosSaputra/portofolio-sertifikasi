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
        $projects = [
            ['title' => 'Absensi Pegawai', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-absensi.png', 'description' => 'Aplikasi absensi berbasis CodeIgniter 4 dengan rekap kehadiran dan laporan real-time.', 'stack' => ['CodeIgniter', 'MySQL', 'Bootstrap']],
            ['title' => 'SIM Pegawai', 'category' => 'frontend', 'category_label' => 'Frontend', 'image' => 'images/project-simpeg.png', 'description' => 'Sistem informasi pegawai dengan pengelolaan data, CRUD, dan akses multi-role.', 'stack' => ['Laravel', 'Tailwind CSS', 'MySQL']],
            ['title' => 'Penggajian Pegawai', 'category' => 'web', 'category_label' => 'Web App', 'image' => 'images/project-penggajian.png', 'description' => 'Aplikasi penggajian otomatis dengan perhitungan tunjangan dan laporan yang terstruktur.', 'stack' => ['Laravel', 'PHP', 'MySQL']],
            ['title' => 'Pengadaan Barang', 'category' => 'design', 'category_label' => 'UI/UX', 'image' => 'images/project-pengadaan.png', 'description' => 'Antarmuka pengadaan barang yang ringkas, terhubung dengan basis data Google Spreadsheet.', 'stack' => ['HTML', 'CSS', 'JavaScript']],
        ];

        return view('portfolio', compact('projects'));
    }

    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        Log::info('Pesan baru dari formulir portofolio.', $validated);

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih sudah menghubungi saya!');
    }
}
