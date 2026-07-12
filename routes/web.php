<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontPageController;
use App\Http\Controllers\Backend\BackendPageController;

Route::controller(FrontPageController::class)->group(function () {

    Route::get('/', 'home')->name('pages.home');

    Route::get('/about', 'about')->name('pages.about');

    Route::get('/platforms', 'platforms')->name('pages.platforms');

    Route::get('/blog', 'blog')->name('pages.blog');

    Route::get('/contact', 'contact')->name('pages.contact');

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->as('admin.')
    ->controller(BackendPageController::class)
    ->group(function () {

        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/about', 'about')->name('about');

        Route::get('/platforms', 'platforms')->name('platforms');

        Route::get('/blog', 'blog')->name('blog');

        Route::get('/contact', 'contact')->name('contact');
    });