<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// User Authentication Routes (for React app)
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');


// Protected Routes (Require Sanctum Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user-profile', [UserProfileController::class, 'profile'])->name('user.profile');

    // User Complaint Routes
    Route::prefix('complaints')->name('complaints.')->group(function () {
        Route::post('/', [UserComplaintController::class, 'store'])->name('store'); // User creates complaint
        Route::get('/', [UserComplaintController::class, 'index'])->name('index'); // User views their complaints
        Route::get('/{id}', [UserComplaintController::class, 'show'])->name('show'); // View specific complaint
    });
});
