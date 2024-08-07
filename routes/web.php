<?php

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientDashboardController;

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

Route::get('/services', function () {
    return view('services');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   //Lessons
    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessons/{id}', [LessonController::class, 'show'])->name('lessons.show');
    Route::get('/lessons/{id}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/lessons/{id}', [LessonController::class, 'update'])->name('lessons.update');
   //Bookings
    Route::resource('bookings', BookingController::class)->except(['show', 'create', 'edit']);
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
   

});


Route::middleware(['auth', 'can:AdminOrClient'])->group(function () {
    // User profile
    Route::get('/user-profile/create', [UserProfileController::class, 'create'])->name('userProfile.create');
    Route::get('/user-profile/{id}', [UserProfileController::class, 'show'])->name('userProfile.show');
    Route::get('/user-profile/{id}/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
    Route::post('/user-profile', [UserProfileController::class, 'store'])->name('userProfile.store');
    Route::put('/user-profile/{id}', [UserProfileController::class, 'store'])->name('userProfile.update');
});

Route::middleware(['auth', 'can:Client'])->group(function () {
    // Client Dashboard
    Route::get('/client/dashboard', [ClientDashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('client.dashboard');
    Route::post('bookings/{booking}/clientRemarks', [BookingController::class, 'addClientRemarks'])->name('bookings.addClientRemarks');
    Route::get('/client/lessons', [BookingController::class, 'clientBookings'])->name('client.lessons');


});

Route::middleware(['auth', 'can:Tutor'])->group(function () {
    // Tutor Dashboard
    Route::get('/tutor/dashboard', function () {return view('tutor.dashboard');})->middleware(['auth', 'verified'])->name('tutor.dashboard');
    Route::get('/tutor-profile/{id}', [TutorProfileController::class, 'show'])->name('tutorProfile.show');
    Route::get('/tutor-profile/create', [TutorProfileController::class, 'create'])->name('tutorProfile.create');
    Route::get('/tutor-profile/{id}/edit', [TutorProfileController::class, 'edit'])->name('tutorProfile.edit');
    Route::post('/tutor-profile', [TutorProfileController::class, 'store'])->name('tutorProfile.store');
    Route::put('/tutor-profile/{id}', [TutorProfileController::class, 'store'])->name('tutorProfile.update');
    //Bookings
    Route::post('bookings/{booking}/tutorRemarks', [BookingController::class, 'addTutorRemarks'])->name('bookings.addTutorRemarks');

});

Route::middleware(['auth', 'can:Admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->middleware(['auth', 'verified'])->name('admin.dashboard');

    Route::get('/admin/lessons', [LessonController::class, 'allLessons'])->name('admin.lessons');
    Route::delete('/lessons/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');
    //Bookings
    Route::get('bookings/admin/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::get('bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::get('bookings/admin/all', [BookingController::class, 'allBookings'])->name('bookings.all');


});

require __DIR__.'/auth.php';
