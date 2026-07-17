<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontPageController;  // <-- lowercase 'frontend'
use App\Http\Controllers\Backend\BackendPageController;
use App\Http\Controllers\frontend\RegisterController;    // <-- lowercase 'frontend'
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PlatformController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// TEMPORARY TEST ROUTE - Remove after testing
Route::get('/test', function() {
    return 'Test route works!';
});

Route::get('/test-platforms', [App\Http\Controllers\frontend\FrontPageController::class, 'platforms']);


// ===== FRONTEND ROUTES =====
Route::get('/home', [FrontPageController::class, 'home'])->name('pages.home');
Route::get('/about', [FrontPageController::class, 'about'])->name('pages.about');
Route::get('/our-platforms', [FrontPageController::class, 'platforms'])->name('pages.platforms');
Route::get('/planes', [FrontPageController::class, 'planes'])->name('pages.planes');
Route::get('/blog', [FrontPageController::class, 'blog'])->name('pages.blog');
Route::get('/contact', [FrontPageController::class, 'contact'])->name('pages.contact');

Route::get('/user-profile', [FrontPageController::class, 'userProfile'])
    ->name('pages.userprofile')
    ->middleware('auth');

// User Profile Update Route
Route::post('/user-profile/update', [RegisterController::class, 'updateProfile'])
    ->name('pages.userprofile.update')
    ->middleware('auth');

// Auth Routes
Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('auth.auth');
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('auth.login.page');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/login', [RegisterController::class, 'login'])->name('auth.login');
Route::post('/logout', [RegisterController::class, 'logout'])->name('auth.logout');

// Contact Route
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// ===== ADMIN ROUTES GROUP =====
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // 1. BackendPageController - Main pages
        Route::controller(BackendPageController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/about', 'about')->name('about');
            Route::get('/platforms', 'platforms')->name('platforms');
            Route::get('/contact', 'contact')->name('contact');
            Route::get('/profile', 'profile')->name('profile');
        });

        // 2. BlogController - Blog CRUD operations
        Route::controller(BlogController::class)->group(function () {
            Route::get('/blog', 'index')->name('blog.index');
            Route::get('/blog/create', 'create')->name('blog.create');
            Route::post('/blog/store', 'store')->name('blog.store');
            Route::get('/blog/{id}/edit', 'edit')->name('blog.edit');
            Route::put('/blog/{id}/update', 'update')->name('blog.update');
            Route::delete('/blog/{id}/delete', 'destroy')->name('blog.destroy');
        });

        // 3. AboutController - About routes
        Route::controller(AboutController::class)->group(function () {
            Route::get('/about/edit', 'edit')->name('about.edit');
            Route::post('/about/update', 'update')->name('about.update');
        });

        // 4. Contact routes
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // 5. User routes
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::put('/user/{user}/password', [UserController::class, 'updatePassword'])->name('user.password');

        // 6. Profile update routes
        Route::post('/profile/update', [RegisterController::class, 'updateProfile'])->name('profile.update');

        // 7. Platforms admin — full CRUD
        Route::controller(PlatformController::class)->group(function () {
            Route::get('/platforms', 'index')->name('platforms');
            Route::get('/platforms/create', 'create')->name('platforms.create');
            Route::post('/platforms', 'store')->name('platforms.store');
            Route::get('/platforms/{platform}/edit', 'edit')->name('platforms.edit');
            Route::put('/platforms/{platform}', 'update')->name('platforms.update');
            Route::delete('/platforms/{platform}', 'destroy')->name('platforms.destroy');
        });
    });