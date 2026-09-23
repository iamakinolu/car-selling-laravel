<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarController::class, 'home'])->name('home');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');
    Route::get('/password-reset', [AuthController::class, 'showPasswordReset'])->name('password.request');
    Route::post('/password-reset', [AuthController::class, 'passwordReset'])->name('password.email');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/my-cars', [CarController::class, 'myCars'])->name('cars.mine');
    Route::get('/cars/create/new', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::post('/cars/{car}/watchlist', [CarController::class, 'toggleWatchlist'])->name('cars.watchlist');
    Route::get('/watchlist', [CarController::class, 'watchlist'])->name('watchlist');
    Route::get('/cars/{car}/images', [CarController::class, 'images'])->name('cars.images');
    Route::post('/cars/{car}/images', [CarController::class, 'uploadImages'])->name('cars.images.upload');
});
