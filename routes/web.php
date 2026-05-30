<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FreeSubscriptionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\FreeSubscriptionController as AdminFreeSubscriptionController;
use App\Http\Controllers\Admin\SessionLogController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GuideController as AdminGuideController;
use App\Http\Controllers\Admin\MailController as AdminOfficialMailController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Utility routes moved to admin middleware for security

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/sections', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/sections/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/how-to-run', [GuideController::class, 'index'])->name('how-to-run');

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});

// Checkout Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Auth Routes (Frontend)
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/login/reset', [App\Http\Controllers\Auth\LoginController::class, 'resetVerification'])->name('login.reset');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/register/reset', [App\Http\Controllers\Auth\RegisterController::class, 'resetVerification'])->name('register.reset');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(['auth'])->group(function () {
    Route::get('/free-subscriptions', [FreeSubscriptionController::class, 'index'])->name('free-subscriptions.index');
    Route::post('/free-subscriptions/claim', [FreeSubscriptionController::class, 'claim'])->name('free-subscriptions.claim');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'requestPasswordChange'])->name('profile.password.request');
    Route::get('/profile/password/verify', [ProfileController::class, 'showVerifyForm'])->name('profile.password.verify');
    Route::post('/profile/password/verify', [ProfileController::class, 'confirmPasswordChange'])->name('profile.password.confirm');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Professional Luxury Dashboard)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/realtime-stats', [DashboardController::class, 'realtimeStats'])->name('dashboard.realtime');
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // Subscription Keys
    Route::get('/subscription-keys', [AdminFreeSubscriptionController::class, 'index'])->name('subscription-keys.index');
    Route::post('/subscription-keys', [AdminFreeSubscriptionController::class, 'store'])->name('subscription-keys.store');
    Route::get('/subscription-keys/{plan}/edit', [AdminFreeSubscriptionController::class, 'edit'])->name('subscription-keys.edit');
    Route::put('/subscription-keys/{plan}', [AdminFreeSubscriptionController::class, 'update'])->name('subscription-keys.update');
    Route::get('/subscription-keys/claims', [AdminFreeSubscriptionController::class, 'claims'])->name('subscription-keys.claims');
    Route::get('/subscription-keys/expiring', [AdminFreeSubscriptionController::class, 'expiringSoon'])->name('subscription-keys.expiring');
    Route::post('/subscription-keys/claims/{claim}/finalize', [AdminFreeSubscriptionController::class, 'finalizeClaim'])->name('subscription-keys.claims.finalize');
    Route::post('/subscription-keys/claims/{claim}/approve', [AdminFreeSubscriptionController::class, 'approve'])->name('subscription-keys.claims.approve');
    Route::post('/subscription-keys/{plan}/alert', [AdminFreeSubscriptionController::class, 'sendExpirationAlert'])->name('subscription-keys.alert');
    Route::delete('/subscription-keys/{plan}', [AdminFreeSubscriptionController::class, 'destroy'])->name('subscription-keys.destroy');

    Route::get('/session-logs', [SessionLogController::class, 'index'])->name('session-logs.index');
    
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('/orders/{order}/mark-completed', [OrderController::class, 'markAsCompleted'])->name('orders.mark-completed');
    
    // Communication / Messaging
    Route::post('/send-whatsapp', [App\Http\Controllers\Admin\CommunicationController::class, 'sendWhatsApp'])->name('send.whatsapp');
    Route::post('/send-email', [App\Http\Controllers\Admin\CommunicationController::class, 'sendEmail'])->name('send.email');
    
    // Official Mail System
    Route::get('/mail', [AdminOfficialMailController::class, 'index'])->name('mail.index');
    Route::post('/mail/send', [AdminOfficialMailController::class, 'send'])->name('mail.send');
    
    // Notification/Messaging Center
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/poll-orders', [AdminNotificationController::class, 'pollOrders'])->name('notifications.pollOrders');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    // Banners & Guides
    Route::resource('banners', BannerController::class);
    Route::resource('guides', AdminGuideController::class);

    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::post('/clear-cache', function() {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');

        return redirect()->back()->with('success', 'Cache cleared successfully.');
    })->name('clear-cache');

    // Storage Fix (Admin Only)
    Route::get('/fix-storage', function () {
        $publicStoragePath = public_path('storage');
        if (file_exists($publicStoragePath) || is_link($publicStoragePath)) {
            if (PHP_OS_FAMILY === 'Windows') {
                exec('rmdir /s /q "' . $publicStoragePath . '"');
            } else {
                \Illuminate\Support\Facades\File::deleteDirectory($publicStoragePath);
            }
            @unlink($publicStoragePath);
        }
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return redirect()->back()->with('success', 'Storage link fixed successfully!');
    })->name('fix-storage');
});

