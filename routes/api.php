<?php

use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\UserComplaintController;
use App\Http\Controllers\API\UserProfileController;
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
Route::post('/register', [UserAuthController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user-profile', [UserProfileController::class, 'profile'])->name('user.profile');
    Route::post('/logout', [UserAuthController::class, 'logout']);

    // User Complaint Routes
    Route::prefix('complaints')->name('complaints.')->group(function () {
        Route::post('/', [UserComplaintController::class, 'store'])->name('store');
        Route::get('/', [UserComplaintController::class, 'index'])->name('index'); 
        Route::get('/{id}', [UserComplaintController::class, 'show'])->name('show'); 
    });
});
