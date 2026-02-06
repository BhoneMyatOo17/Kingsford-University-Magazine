<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (requires authentication)
Route::middleware(['auth', 'verified'])->group(function () {
    // View profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    // Edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Update profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Change password form
    Route::get('/profile/password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change.form');
    
    // Change password
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('password.change');
});

require __DIR__.'/auth.php';
