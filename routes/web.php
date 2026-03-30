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
use App\Http\Controllers\MagazineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AnalyticsController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', fn() => view('terms'))->name('terms');

Route::get('/privacy', fn() => view('privacy'))->name('privacy');

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
// MAGAZINE ROUTES (public) — must be AFTER auth magazine routes so {magazine} doesn't swallow 'create'
// ============================================
Route::get('/magazine', [MagazineController::class, 'index'])->name('magazine.index');
Route::post('/magazine/{id}/restore', [MagazineController::class, 'restore'])->name('magazine.restore');
Route::delete('/magazine/{id}/force-delete', [MagazineController::class, 'forceDelete'])->name('magazine.forceDelete');


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

    // ============================================
    // MAGAZINE MANAGEMENT ROUTES (manager/admin only)
    // ============================================
    Route::middleware(['role:marketing_manager|admin'])->group(function () {
        // Magazine editions
        Route::get('/magazine/create', [MagazineController::class, 'create'])->name('magazine.create');
        Route::post('/magazine', [MagazineController::class, 'store'])->name('magazine.store');
        Route::get('/magazine/{magazine}/edit', [MagazineController::class, 'edit'])->name('magazine.edit');
        Route::put('/magazine/{magazine}', [MagazineController::class, 'update'])->name('magazine.update');
        Route::delete('/magazine/{magazine}', [MagazineController::class, 'destroy'])->name('magazine.destroy');
    });

    // Guest Management
    Route::middleware(['role:admin|marketing_coordinator'])->group(function () {
        Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
        Route::delete('/guests/{user}', [GuestController::class, 'destroy'])->name('guests.destroy');
    });

    // Analytics
    Route::middleware(['role:admin'])->prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/contributions', [AnalyticsController::class, 'contributions'])->name('contributions');
        Route::get('/users', [AnalyticsController::class, 'users'])->name('users');
        Route::get('/faculty', [AnalyticsController::class, 'facultyIndex'])->name('faculty.index');
    });

    // Faculty show — admin + guest
    Route::middleware(['auth', 'verified', 'check.temporary.password', 'check.user.active'])
        ->get('/analytics/faculty/{faculty}', [AnalyticsController::class, 'facultyShow'])
        ->name('analytics.faculty.show');
});

// ============================================
// MAGAZINE SHOW ROUTES (public)
// ============================================
Route::get('/magazine/{magazine}', [MagazineController::class, 'show'])->name('magazine.show');

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
    Route::middleware(['role:marketing_coordinator|marketing_manager|admin|guest|student'])->group(function () {
        Route::get('/contributions', [ContributionController::class, 'index'])->name('contributions.index');
    });

    // Manager + Admin: download — MUST be registered before contributions.show
    // so 'download' is not swallowed as a {contribution} parameter
    Route::get('/contributions/download', [ContributionController::class, 'download'])
        ->middleware(['role:marketing_manager|admin'])
        ->name('contributions.download');

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

    Route::middleware(['role:student|marketing_coordinator'])->group(function () {
        Route::get('/reports/{report}', [ReportController::class, 'myReport'])->name('reports.my');
    });

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])
        ->name('notifications.read-all');
});
