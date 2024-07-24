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

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Client Dashboard
Route::get('/client/dashboard', function () {
    return view('client.dashboard');
})->middleware(['auth', 'verified'])->name('client.dashboard');

// Tutor Dashboard
Route::get('/tutor/dashboard', function () {
    return view('tutor.dashboard');
})->middleware(['auth', 'verified'])->name('tutor.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // User profile
    Route::get('/user-profile/{id}', [UserProfileController::class, 'show'])->name('userProfile.show');
    Route::get('/user-profile/create', [UserProfileController::class, 'create'])->name('userProfile.create');
    Route::get('/user-profile/{id}/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
    Route::post('/user-profile', [UserProfileController::class, 'store'])->name('userProfile.store');
    Route::put('/user-profile/{id}', [UserProfileController::class, 'store'])->name('userProfile.update');
   //Lessons
    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessons/{id}', [LessonController::class, 'show'])->name('lessons.show');
    Route::get('/lessons/{id}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/lessons/{id}', [LessonController::class, 'update'])->name('lessons.update');
   

    
});

Route::middleware(['auth', 'can:Tutor'])->group(function () {
    Route::get('/tutor-profile/{id}', [TutorProfileController::class, 'show'])->name('tutorProfile.show');
    Route::get('/tutor-profile/create', [TutorProfileController::class, 'create'])->name('tutorProfile.create');
    Route::get('/tutor-profile/{id}/edit', [TutorProfileController::class, 'edit'])->name('tutorProfile.edit');
    Route::post('/tutor-profile', [TutorProfileController::class, 'store'])->name('tutorProfile.store');
    Route::put('/tutor-profile/{id}', [TutorProfileController::class, 'store'])->name('tutorProfile.update');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/lessons', [LessonController::class, 'allLessons'])->name('admin.lessons');
    Route::delete('/lessons/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');

});

require __DIR__.'/auth.php';
