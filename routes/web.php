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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('app/dashboard', [DashboardController::class, 'index'])->name('app.dashboard');

    // Resources
    Route::resource('expenses', ExpenseController::class);
    Route::resource('incomes', IncomeController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('budgets', BudgetController::class)->except(['show']);

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Admin area (controller enforces admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('users', [AdminController::class, 'index'])->name('users.index');
        Route::get('users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::patch('users/{user}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__.'/auth.php';
