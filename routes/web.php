<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/contact', [PortfolioController::class, 'contact'])
    ->middleware('throttle:6,1')
    ->name('contact.store');
