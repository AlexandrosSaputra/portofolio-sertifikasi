<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Satu halaman portofolio berisi seluruh section; navigasi memakai anchor.
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');

// Dibatasi enam percobaan per menit agar formulir publik tidak disalahgunakan.
Route::post('/contact', [PortfolioController::class, 'contact'])
    ->middleware('throttle:6,1')
    ->name('contact.store');
