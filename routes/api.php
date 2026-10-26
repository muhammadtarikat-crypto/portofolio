<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [PortfolioController::class, 'profile']);
Route::get('/skills', [PortfolioController::class, 'skills']);
Route::get('/projects', [PortfolioController::class, 'projects']);
Route::get('/experiences', [PortfolioController::class, 'experiences']);
Route::get('/certificates', [PortfolioController::class, 'certificates']);
Route::post('/contacts', [ContactController::class, 'store'])->middleware('throttle:5,1'); // maks 5 pesan/menit
