<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontPageController;
use App\Http\Controllers\Backend\BackendPageController;
use App\Http\Controllers\frontend\RegisterController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PlatformController;
use App\Http\Controllers\Backend\DepositController;
use App\Http\Controllers\Backend\WithdrawalController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\PlaneController;
use App\Http\Controllers\Backend\PlaneBuyerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\UserAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// API ROUTES (Merged from api.php)
// ============================================================
Route::prefix('api')->group(function () {

    // === TEST ROUTE ===
    Route::get('/session-test', function () {
        return response()->json([
            'session_id' => session()->getId(),
            'auth_check' => Auth::check(),
            'auth_user' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->user_name : null,
        ]);
    });

    // === PUBLIC ROUTES ===
    Route::get('/payment-methods', [DepositController::class, 'getPaymentMethods']);
    Route::get('/test', function () {
        return response()->json(['message' => 'API works!']);
    });

    // === AUTHENTICATED ROUTES ===
    Route::middleware(['auth'])->group(function () {

        // User Profile
        Route::get('/user/profile', function () {
            if (Auth::check()) {
                return response()->json([
                    'success' => true,
                    'user' => Auth::user()
                ]);
            }
            return response()->json(['success' => false], 401);
        });

        // Deposit Routes
        Route::post('/deposit/store', [DepositController::class, 'store']);
        Route::post('/deposit/{id}/submit-receipt', [DepositController::class, 'submitReceipt']);
        Route::get('/deposit/check-receipt', [DepositController::class, 'checkPendingReceipt']);
        Route::get('/deposit/user-deposits', [DepositController::class, 'getUserDeposits']);

        // Withdrawal Routes
        Route::post('/withdrawal/store', [WithdrawalController::class, 'store']);
        Route::get('/withdrawal/user', [WithdrawalController::class, 'getUserWithdrawals']);
        Route::get('/withdrawal/statistics', [WithdrawalController::class, 'statistics']);
    });

    // === ADMIN API ROUTES (for AJAX calls) ===
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/deposits', [DepositController::class, 'getAdminDeposits']);
        Route::get('/admin/deposits/{id}', [DepositController::class, 'show']);
        Route::post('/admin/deposits/{id}/update-status', [DepositController::class, 'updateStatus']);
        Route::get('/admin/deposits/statistics', [DepositController::class, 'statistics']);

        Route::get('/admin/withdrawals', [WithdrawalController::class, 'getAdminWithdrawals']);
        Route::get('/admin/withdrawals/{id}', [WithdrawalController::class, 'show']);
        Route::put('/admin/withdrawals/{id}/status', [WithdrawalController::class, 'updateStatus']);
        Route::get('/admin/withdrawals/pending-count', [WithdrawalController::class, 'pendingCount']);
    });
});

// ============================================================
// FRONTEND ROUTES
// ============================================================

// TEMPORARY TEST ROUTE - Remove after testing
Route::get('/test', function () {
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

// Plane purchase / payment submission (frontend, logged-in users only — NOT admin-only)
Route::post('/planes/submit-payment', [PlaneBuyerController::class, 'store'])
    ->middleware('auth')
    ->name('pages.planes.submit-payment');

// Auth Routes
Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('auth.auth');
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('auth.login.page');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/login', [RegisterController::class, 'login'])->name('auth.login');
Route::post('/logout', [RegisterController::class, 'logout'])->name('auth.logout');

// Google OAuth Routes
Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Contact Route
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// ===== HISTORY ROUTES =====
Route::get('/deposit-history', [FrontPageController::class, 'depositHistory'])
    ->name('pages.deposit.history')
    ->middleware('auth');

Route::get('/withdraw-history', [FrontPageController::class, 'withdrawHistory'])
    ->name('pages.withdraw.history')
    ->middleware('auth');

// ===== REVIEW ROUTES =====
// Frontend routes for reviews
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
});

// API route for getting approved reviews (public)
Route::get('/api/reviews/approved', [ReviewController::class, 'getApprovedReviews'])->name('api.reviews.approved');

// ===== CONTACT ROUTES (for AJAX) =====
Route::get('/contacts/unread-count', function () {
    return response()->json(['count' => App\Models\Contact::where('is_read', false)->count()]);
})->name('admin.contacts.unread-count');

Route::post('/contacts/{id}/mark-read', [App\Http\Controllers\Backend\ContactController::class, 'markAsRead'])->name('admin.contacts.mark-read');

// ============================================================
// ADMIN ROUTES GROUP - ONLY ONE PLACE FOR ADMIN ROUTES
// ============================================================
// ============================================================
// ADMIN ROUTES GROUP - ONLY ONE PLACE FOR ADMIN ROUTES
// ============================================================
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // 1. Dashboard - Use DashboardController (ONLY ONE)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 2. BackendPageController - Other pages (about, platforms, contact, profile)
        Route::controller(BackendPageController::class)->group(function () {
            Route::get('/about', 'about')->name('about');
            Route::get('/platforms', 'platforms')->name('platforms');
            Route::get('/contact', 'contact')->name('contact');
            Route::get('/profile', 'profile')->name('profile');
        });

        // 3. BlogController - Blog CRUD operations
        Route::controller(BlogController::class)->group(function () {
            Route::get('/blog', 'index')->name('blog.index');
            Route::get('/blog/create', 'create')->name('blog.create');
            Route::post('/blog/store', 'store')->name('blog.store');
            Route::get('/blog/{id}/edit', 'edit')->name('blog.edit');
            Route::put('/blog/{id}/update', 'update')->name('blog.update');
            Route::delete('/blog/{id}/delete', 'destroy')->name('blog.destroy');
        });

        // 4. AboutController - About routes
        Route::controller(AboutController::class)->group(function () {
            Route::get('/about/edit', 'edit')->name('about.edit');
            Route::post('/about/update', 'update')->name('about.update');
        });

        // 5. Contact routes
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // 6. User routes
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::put('/user/{user}/password', [UserController::class, 'updatePassword'])->name('user.password');

        // 7. Profile update routes
        Route::post('/profile/update', [RegisterController::class, 'updateProfile'])->name('profile.update');

        // 8. Platforms admin — full CRUD
        Route::controller(PlatformController::class)->group(function () {
            Route::get('/platforms', 'index')->name('platforms');
            Route::get('/platforms/create', 'create')->name('platforms.create');
            Route::post('/platforms', 'store')->name('platforms.store');
            Route::get('/platforms/{platform}/edit', 'edit')->name('platforms.edit');
            Route::put('/platforms/{platform}', 'update')->name('platforms.update');
            Route::delete('/platforms/{platform}', 'destroy')->name('platforms.destroy');
        });

        // === Planes CRUD Routes ===
        Route::controller(PlaneController::class)->group(function () {
            Route::get('/planes', 'index')->name('planes');
            Route::get('/planes/create', 'create')->name('planes.create');
            Route::post('/planes', 'store')->name('planes.store');
            Route::get('/planes/{plane}/edit', 'edit')->name('planes.edit');
            Route::put('/planes/{plane}', 'update')->name('planes.update');
            Route::delete('/planes/{plane}', 'destroy')->name('planes.destroy');
        });

        // 9. User Accounts admin — full CRUD
        Route::controller(UserAccountController::class)->group(function () {
            Route::get('/user-accounts', 'index')->name('UserAccounts');
            Route::get('/user-accounts/create', 'create')->name('UserAccounts.create');
            Route::post('/user-accounts', 'store')->name('UserAccounts.store');
            Route::delete('/user-accounts/{userAccount}', 'destroy')->name('UserAccounts.destroy');
        });

        // ===== ADMIN DEPOSIT ROUTES =====
        Route::get('/deposits', [DepositController::class, 'index'])->name('deposits.index');
        Route::get('/deposits/{id}', [DepositController::class, 'show'])->name('deposits.show');
        Route::post('/deposits/{id}/update-status', [DepositController::class, 'updateStatus'])->name('deposits.update-status');
        Route::get('/deposits/statistics', [DepositController::class, 'statistics'])->name('deposits.statistics');

        // ===== ADMIN WITHDRAWAL ROUTES =====
        Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::get('/withdrawals/{id}', [WithdrawalController::class, 'show'])->name('withdrawals.show');
        Route::put('/withdrawals/{id}/status', [WithdrawalController::class, 'updateStatus'])->name('withdrawals.update-status');
        Route::get('/withdrawals/pending-count', [WithdrawalController::class, 'pendingCount'])->name('withdrawals.pending-count');

        // ===== ADMIN REVIEW ROUTES =====
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::put('/reviews/{id}/status', [ReviewController::class, 'updateStatus'])->name('reviews.update-status');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::post('/reviews/bulk-approve', [ReviewController::class, 'bulkApprove'])->name('reviews.bulk-approve');


        // ===== PAYMENT METHODS CRUD ROUTES =====
        Route::controller(\App\Http\Controllers\Backend\PaymentMethodController::class)->group(function () {
            Route::get('/payment-methods', 'index')->name('payment-methods.index');
            Route::get('/payment-methods/create', 'create')->name('payment-methods.create');
            Route::post('/payment-methods', 'store')->name('payment-methods.store');
            Route::get('/payment-methods/{id}/edit', 'edit')->name('payment-methods.edit');
            Route::put('/payment-methods/{id}', 'update')->name('payment-methods.update');
            Route::delete('/payment-methods/{id}', 'destroy')->name('payment-methods.destroy');
        });
    });