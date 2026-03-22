<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\FirebaseAuth;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('pages.landing');
});

// Auth routes (no middleware)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/verify-token', [AuthController::class, 'verifyToken']);
Route::get('/post-login', [AuthController::class, 'handlePostLogin']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/set-role', [AuthController::class, 'setRole']);
Route::get('/logout', [AuthController::class, 'logout']);

// Developer page
Route::get('/developer', function () {
    return view('pages.developer');
});

// Protected routes
Route::middleware(FirebaseAuth::class)->group(function () {
    // Rider routes
    Route::get('/rider/home', [RiderController::class, 'home']);
    Route::post('/rider/status', [RiderController::class, 'updateStatus']);
    Route::get('/rider/location', function () {
        return view('rider.location', ['name' => session('name')]);
    });

    // Car Owner routes
    Route::get('/car-owner/home', [CarOwnerController::class, 'home']);
    Route::post('/car-owner/status', [CarOwnerController::class, 'updateStatus']);

    // Customer routes
    Route::get('/customer/choose', [CustomerController::class, 'chooseRide']);
    Route::get('/customer/auto', [CustomerController::class, 'autoHome']);
    Route::get('/customer/car', [CustomerController::class, 'carHome']);

    // Listing routes
    Route::get('/list/auto', [ListingController::class, 'autoList']);
    Route::get('/list/car', [ListingController::class, 'carList']);

    // Settings routes
    Route::get('/settings', [SettingsController::class, 'show']);
    Route::post('/settings/phone', [SettingsController::class, 'updatePhone']);
    Route::post('/settings/delete', [SettingsController::class, 'deleteAccount']);

    // Rating routes (JSON API)
    Route::post('/rating/submit', [RatingController::class, 'submit']);
    Route::get('/rating/average', [RatingController::class, 'getAverage']);
});
