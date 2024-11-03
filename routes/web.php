<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminComplaintController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AdminAuthController::class, 'showLoginPage'])->name('admin.login.view');
Route::post('/auth/login', [AdminAuthController::class, 'login'])->name('admin.login');


Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard.view');
    Route::post('/auth/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // Admin Complaint Management Routes
    Route::prefix('admin/complaints')->name('admin.complaints.')->group(function () {
        Route::get('/', [AdminComplaintController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminComplaintController::class, 'show'])->name('show');
        Route::patch('/{id}', [AdminComplaintController::class, 'update'])->name('update');
    });

    // Admin Reports Routes
    Route::prefix('admin/reports')->name('admin.reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/status', [ReportController::class, 'statusReport'])->name('status');
        Route::get('/priority', [ReportController::class, 'priorityReport'])->name('priority');
        Route::get('/trend', [ReportController::class, 'trendReport'])->name('trend');
    });
});