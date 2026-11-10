<?php

use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::prefix('portfolio')->name('portfolio.')->group(function () {
    Route::get('/profile', [PortfolioController::class, 'profile'])->name('profile');
    Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills');
    Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects.index');
    Route::get('/projects/{slug}', [PortfolioController::class, 'projectDetail'])->name('projects.show');
    Route::get('/experiences', [PortfolioController::class, 'experiences'])->name('experiences');
    Route::get('/certificates', [PortfolioController::class, 'certificates'])->name('certificates');
});

Route::post('/contacts', [ContactController::class, 'store'])->middleware('throttle:5,1'); // maks 5 pesan/menit
