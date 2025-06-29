<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CompressController;
use App\Http\Controllers\MergeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/convert', [ConvertController::class, 'index'])->name('convert.index');
Route::post('/convert', [ConvertController::class, 'convert'])->name('convert.process');
Route::get('/result/{id}', [ConvertController::class, 'result'])->name('convert.result');
Route::get('/download/{id}', [ConvertController::class, 'download'])->name('convert.download');

// Compress Routes
Route::get('/compress', [CompressController::class, 'index'])->name('compress.index');
Route::post('/compress', [CompressController::class, 'compress'])->name('compress.process');
Route::get('/compress/result/{id}', [CompressController::class, 'result'])->name('compress.result');
Route::get('/compress/download/{id}', [CompressController::class, 'download'])->name('compress.download');

// Page Routes
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/tutorial', [PageController::class, 'tutorial'])->name('tutorial');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/team', [PageController::class, 'team'])->name('team');
