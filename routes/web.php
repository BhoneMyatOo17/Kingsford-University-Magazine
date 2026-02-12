<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Auth routes (login, register, etc.) - handled by Breeze
require __DIR__.'/auth.php';

// ============================================
// TEMPORARY PASSWORD CHANGE ROUTES
// Must be accessible BEFORE check.temporary.password middleware
// Only auth required (not verified) to prevent redirect loops
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [PasswordChangeController::class, 'showChangePasswordForm'])
        ->name('temporary-password.change');
    Route::post('/change-password', [PasswordChangeController::class, 'changePassword'])
        ->name('temporary-password.update');
});

// ============================================
// AUTHENTICATED ROUTES
// All routes below require: auth + verified + password changed + active user
// ============================================
Route::middleware(['auth', 'verified', 'check.temporary.password', 'check.user.active'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ============================================
    // PROFILE ROUTES
    // ============================================
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        
        // Profile Password Change (different from temporary password)
        Route::get('/password', [ProfileController::class, 'showChangePasswordForm'])
            ->name('password.form');
        Route::put('/password', [ProfileController::class, 'changePassword'])
            ->name('password.update');
    });

    // ============================================
    // USER MANAGEMENT ROUTES
    // IMPORTANT: Specific routes MUST come before wildcard routes
    // ============================================
    
    // Routes accessible by Admin only - MUST BE FIRST
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
    });

    // Routes accessible by both Admin and Marketing Manager - AFTER specific routes
    Route::middleware(['role:admin|marketing_manager'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });

});
// ============================================
// CONTACT ROUTES
// ============================================

// Public route - Contact form (accessible by everyone)
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin routes - Contact management (only for users with permissions)
Route::middleware(['auth', 'permission:view contacts|manage contacts'])->prefix('admin')->name('contact.')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('show');
});

Route::middleware(['auth', 'permission:manage contacts'])->prefix('admin')->name('contact.')->group(function () {
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('update');
});

Route::middleware(['auth', 'permission:delete contacts'])->prefix('admin')->name('contact.')->group(function () {
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('destroy');
});