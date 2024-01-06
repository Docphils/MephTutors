<?php

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\BookingController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [UserProfileController::class, 'show'])->name('userProfile.show');
    Route::get('/profile/create', [UserProfileController::class, 'create'])->name('userProfile.create');
    Route::get('/profile/{id}/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
    Route::post('/profile/store/{id?}', [UserProfileController::class, 'store'])->name('userProfile.store');

    Route::middleware(['can:Admin'])->group(function () {
        // Routes accessible only by users with the 'Admin' gate
        
    });

    Route::middleware(['can:Tutor'])->group(function () {
        // Routes accessible only by users with the 'Tutor' gate
        Route::get('/tutor/dashboard', [TutorProfileController::class, 'dashboard'])->name('tutor.dashboard');
    });
});

require __DIR__.'/auth.php';
