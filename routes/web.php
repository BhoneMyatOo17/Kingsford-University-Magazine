<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyPageController;
use App\Http\Controllers\ProgramPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContributionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/magazine', function () {
    return view('magazine');
})->name('magazine');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/faculties', [FacultyPageController::class, 'index'])->name('faculties.index');

Route::get('/explore/{program}', [ProgramPageController::class, 'show'])->name('programs.public.show');

Route::get('api/faculties/{faculty}/programs', [ProgramController::class, 'byFaculty'])->name('api.faculty.programs');

// Auth routes (login, register, etc.) - handled by Breeze
require __DIR__ . '/auth.php';

// ============================================
// TEMPORARY PASSWORD CHANGE ROUTES
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [PasswordChangeController::class, 'showChangePasswordForm'])
        ->name('temporary-password.change');
    Route::post('/change-password', [PasswordChangeController::class, 'changePassword'])
        ->name('temporary-password.update');
});

// ============================================
// AUTHENTICATED ROUTES
// ============================================
Route::middleware(['auth', 'verified', 'check.temporary.password', 'check.user.active'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('faculty', FacultyController::class);
        Route::post('faculty/{id}/restore', [FacultyController::class, 'restore'])->name('faculty.restore');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('programs', ProgramController::class);
        Route::post('programs/{id}/restore', [ProgramController::class, 'restore'])->name('programs.restore');
    });
});
// ============================================
// CONTACT ROUTES
// ============================================

// Public route - Contact form (accessible by everyone)
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::middleware(['auth'])->get('/my-contact/{contact}', [ContactController::class, 'myContact'])
    ->name('contact.my');

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

/*
|--------------------------------------------------------------------------
| Posts
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Posts — admin management (MUST be before posts.show to avoid {post} swallowing 'create')
    Route::middleware(['role:admin'])->group(function () {
        Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
        Route::resource('posts', PostController::class);
        Route::resource('academic-years', AcademicYearController::class);
    });

    // Posts — viewable by all authenticated users (scoped in controller)
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    /*
    |--------------------------------------------------------------------------
    | Contributions
    |--------------------------------------------------------------------------
    */

    // Student: submit contribution
    Route::middleware(['role:student'])->group(function () {
        Route::get('/posts/{post}/contributions/create', [ContributionController::class, 'create'])->name('contributions.create');
        Route::post('/posts/{post}/contributions', [ContributionController::class, 'store'])->name('contributions.store');
        Route::get('/contributions/{contribution}/edit', [ContributionController::class, 'edit'])->name('contributions.edit');
        Route::put('/contributions/{contribution}', [ContributionController::class, 'update'])->name('contributions.update');
        Route::delete('/contributions/{contribution}', [ContributionController::class, 'destroy'])->name('contributions.destroy');
        Route::delete('/contributions/files/{file}', [ContributionController::class, 'destroyFile'])->name('contributions.files.destroy');
    });

    // Coordinator + Manager: contribution index
    Route::middleware(['role:marketing_coordinator|marketing_manager|admin'])->group(function () {
        Route::get('/contributions', [ContributionController::class, 'index'])->name('contributions.index');
    });

    // Manager + Admin: download selected as ZIP (must be before contributions.show)
    Route::middleware(['role:marketing_manager|admin'])->group(function () {
        Route::get('/contributions/download', [ContributionController::class, 'download'])->name('contributions.download');
    });

    // Show: student (own), coordinator (own faculty), admin, manager
    Route::get('/contributions/{contribution}', [ContributionController::class, 'show'])->name('contributions.show');

    // Coordinator: comment + approval
    Route::middleware(['role:marketing_coordinator'])->group(function () {
        Route::post('/contributions/{contribution}/comment', [ContributionController::class, 'comment'])->name('contributions.comment');
        Route::post('/contributions/{contribution}/toggle-approval', [ContributionController::class, 'toggleApproval'])->name('contributions.toggleApproval');
        Route::post('/contributions/{contribution}/reject', [ContributionController::class, 'reject'])->name('contributions.reject');
    });

    // Report: coordinator or student
    Route::middleware(['role:marketing_coordinator|student'])->group(function () {
        Route::post('/contributions/{contribution}/report', [ContributionController::class, 'report'])->name('contributions.report');
    });

    // Reports management: admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
        Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
    });

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])
        ->name('notifications.read-all');
});
