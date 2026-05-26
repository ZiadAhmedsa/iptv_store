<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GuideController;
use App\Http\Controllers\Api\FreeSubscriptionController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Auth Routes
Route::middleware('throttle:auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

// Public Data Routes
Route::middleware('throttle:api-read')->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/settings', [HomeController::class, 'settings']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{slug}', [CategoryController::class, 'show']);
    Route::get('/guides', [GuideController::class, 'index']);
});

// Contact (public)
Route::post('/contact', [ContactController::class, 'send'])->middleware('throttle:contact');

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/password', [ProfileController::class, 'changePassword']);
    Route::post('/profile/password/request', [ProfileController::class, 'requestPasswordChange']);
    Route::post('/profile/password/confirm', [ProfileController::class, 'confirmPasswordChange']);
    
    // Free Subscriptions
    Route::get('/free-subscriptions', [FreeSubscriptionController::class, 'index']);
    Route::post('/free-subscriptions/claim', [FreeSubscriptionController::class, 'claim']);
    
    // Checkout
    Route::post('/checkout/process', [CheckoutController::class, 'process']);
});
