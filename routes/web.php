<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route
    ::get('dashboard', [AppController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// PHPStan / Psalm
Route::middleware(['auth', 'verified'])
    ->controller(PageController::class)
    ->group(function () {
        Route::get('/api/pages', 'index');
    });

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
