<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Admin Registration Routes (MOVED OUTSIDE auth middleware)
Route::middleware('guest')->group(function () {
    Route::get('/admin/register', [AdminRegisterController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('app/dashboard', [DashboardController::class, 'index'])->name('app.dashboard');
    Route::get('app/dashboard/charts', [DashboardController::class, 'charts'])->name('app.dashboard.charts');

    // Resources
    Route::resource('expenses', ExpenseController::class);
    Route::resource('incomes', IncomeController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('budgets', BudgetController::class)->except(['show']);

    //Analytics
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');

    // Admin routes - ONLY check can:admin, auth is already applied by parent group
    Route::middleware('can:admin')->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
        Route::get('admin/users/{user}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
        Route::put('admin/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('admin/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');
        
    });
    
});

require __DIR__.'/auth.php';