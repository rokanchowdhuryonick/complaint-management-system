<?php

use App\Http\Controllers\AdminAuthController;
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


Route::get('/auth/login', [AdminAuthController::class, 'showLoginPage'])->name('admin.login');
Route::post('/auth/login', [AdminAuthController::class, 'login']);

Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard.view');