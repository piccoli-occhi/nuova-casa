<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// app

Route::middleware(['auth', 'verified'])
    ->controller(AppController::class)
    ->group(function () {
        Route
            ::get('dashboard', 'dashboard')
            ->name('dashboard');
        Route
            ::get('/api/search', 'searXng')
            ->name('sear-xng');
        Route
            ::get('proxy', 'proxy')
            ->name('proxy');
    });

// tags

Route::middleware(['auth', 'verified'])
    ->controller(TagController::class)
    ->group(function () {
        Route
            ::get('/tags', 'index')
            ->name('tags');
        Route
            ::post('/api/tags', 'store')
            ->name('create-tag');
        Route
            ::get('/tags/{tag}', 'show')
            ->name('tag');
    });

// pages

Route::middleware(['auth', 'verified'])
    ->controller(PageController::class)
    ->group(function () {
        Route
            ::post('/api/pages', 'store')
            ->name('create-page');
        Route
            ::delete('/api/pages/{page}', 'destroy')
            ->name('delete-page');
        Route
            ::put('/api/pages/{page}', 'update')
            ->name('update-page');
        Route
            ::get('/api/pages/{page}/read', 'read')
            ->name('read-page');
        // Route
        //     ::get('/api/search', 'searXng')
        //     ->name('sear-xng');
        Route
            ::get('/api/page/graph', 'openGraph')
            ->name('open-graph');
    });

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
