<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// app

Route::middleware(array('auth'))
    ->controller(AppController::class)
    ->group(function () {
        Route::get('dashboard', 'dashboard')
            ->name('dashboard');
        Route::get('/api/search', 'searXng')
            ->name('sear-xng');
        Route::get('proxy', 'proxy')
            ->name('proxy');
        Route::get('/search', 'search')
            ->name('search');
    });

// tags

Route::middleware(array('auth'))
    ->controller(TagController::class)
    ->group(function () {
        Route::get('/tags', 'index')
            ->name('tags');
        Route::delete('/api/tag/{tag}', 'destroy')
            ->name('delete-tag');
        Route::post('/api/tags', 'store')
            ->name('create-tag');
        Route::get('/tags/{tag}', 'show')
            ->name('tag');
    });

// pages

Route::middleware(array('auth'))
    ->controller(PageController::class)
    ->group(function () {
        Route::post('/api/pages', 'store')
            ->name('create-page');
        Route::delete('/api/pages/{page}', 'destroy')
            ->name('delete-page');
        Route::put('/api/pages/{page}', 'update')
            ->name('update-page');
        Route::get('/api/page/graph', 'openGraph')
            ->name('open-graph');
    });

// rss

Route::middleware(array('auth'))
    ->controller(NewsletterController::class)
    ->group(function () {
        Route::get('/newsletters', 'index')
            ->name('rss-list');
        Route::post('/newsletters', 'store')
            ->name('create-rss');
    });

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')
        ->scopes(array('read:user', 'public_repo'))
        ->redirect();
})->name('auth-redirect');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate(array(
        'email' => $githubUser->email,
    ), array(
        'github_id' => $githubUser->id,
        'name' => $githubUser->name,
        'avatar' => $githubUser->avatar,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ));

    Auth::login($user);

    return redirect('/dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
