<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Menyiapkan data untuk satu halaman portofolio. Konten statis diambil
     * dari config/portfolio.php agar controller hanya berperan sebagai
     * penghubung antara rute dan view.
     */
    public function index(): View
    {
        $skillDomains = config('portfolio.skill_domains');

        return view('portfolio', [
            'navigationLinks' => config('portfolio.navigation'),
            'skillDomains' => $skillDomains,
            'skillDomainsByPriority' => collect($skillDomains)->sortBy('priority')->values()->all(),
            'projects' => config('portfolio.projects'),
        ]);
    }

    /**
     * Memvalidasi lalu mencatat metadata pesan kontak. Isi pesan, nama, dan
     * email sengaja tidak masuk log; hanya panjang pesan yang dicatat untuk
     * keperluan operasional.
     */
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
}
