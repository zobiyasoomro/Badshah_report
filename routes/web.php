<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontPageController;
use App\Http\Controllers\Backend\BackendPageController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\AboutController;

// Frontend Pages
Route::controller(FrontPageController::class)->group(function () {
    Route::get('/home', 'home')->name('pages.home');
    Route::get('/about', 'about')->name('pages.about');
    Route::get('/platforms', 'platforms')->name('pages.platforms');
    Route::get('/planes', 'planes')->name('pages.planes');
    Route::get('/blog', 'blog')->name('pages.blog');
    Route::get('/contact', 'contact')->name('pages.contact');
    
    // User Profile Route - Only for authenticated users
    Route::get('/user-profile', 'userProfile')
        ->name('pages.userprofile')
        ->middleware('auth');
});

// Auth Routes
Route::controller(RegisterController::class)->group(function () {
    Route::get('/', 'showRegistrationForm')->name('auth.auth');
    Route::get('/login', 'showLoginForm')->name('auth.login.page');
    Route::post('/register', 'register')->name('auth.register');
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/logout', 'logout')->name('auth.logout');
});

// Contact Route
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// About Page (Frontend)
Route::get('/about', [AboutController::class, 'index'])->name('pages.about');

// Admin Routes
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'admin'])
    ->controller(BackendPageController::class)
    ->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/about', 'about')->name('about');
        Route::get('/platforms', 'platforms')->name('platforms');
        Route::get('/blog', 'blog')->name('blog');
        Route::get('/contact', 'contact')->name('contact');
    });