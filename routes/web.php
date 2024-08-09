<?php

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\TutorRequestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\CrmController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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

});


Route::middleware(['auth', 'can:AdminOrClient'])->group(function () {
    // User profile
    Route::get('/user-profile/create', [UserProfileController::class, 'create'])->name('userProfile.create');
    Route::get('/user-profile/{id}', [UserProfileController::class, 'show'])->name('userProfile.show');
    Route::get('/user-profile/{id}/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
    Route::post('/user-profile', [UserProfileController::class, 'store'])->name('userProfile.store');
    Route::put('/user-profile/{id}', [UserProfileController::class, 'store'])->name('userProfile.update');
    //Tutor Request Route
    Route::put('tutor-requests/{id}', [TutorRequestController::class, 'update'])->name('tutorRequests.update');

});

Route::middleware(['auth', 'can:Client'])->group(function () {
    // Client Dashboard
    Route::get('/client/dashboard', [ClientDashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('client.dashboard');
    Route::post('bookings/{booking}/client_approval', [BookingController::class, 'clientApprovalRemarks'])->name('bookings.clientApproval');
    Route::post('bookings/{booking}/client_acceptance', [BookingController::class, 'clientAcceptanceRemarks'])->name('bookings.clientAcceptance');
    Route::get('/client/lessons', [BookingController::class, 'clientBookings'])->name('client.lessons');

    //Crm Routes
    Route::get('client/crm', [CrmController::class, 'clientIndex'])->name('client.crm.index');
    Route::get('client/crm/create', [CrmController::class, 'create'])->name('client.crm.create');
    Route::post('client/crm', [CrmController::class, 'store'])->name('client.crm.store');
    Route::get('client/crm/{id}', [CrmController::class, 'clientshow'])->name('client.crm.show');
    Route::get('client/crm/{id}/edit', [CrmController::class, 'clientedit'])->name('client.crm.edit');
    Route::put('client/crm/{id}', [CrmController::class, 'update'])->name('client.crm.update');
    Route::delete('client/crm/{id}', [CrmController::class, 'clientDestroy'])->name('client.crm.destroy');
    //Tutor Requests Routes
    Route::get('client/tutor-requests', [TutorRequestController::class, 'clientIndex'])->name('client.tutorRequests.index');
    Route::get('client/tutor-requests/create', [TutorRequestController::class, 'create'])->name('client.tutorRequests.create');
    Route::post('client/tutor-requests', [TutorRequestController::class, 'store'])->name('client.tutorRequests.store');
    Route::get('client/tutor-requests/{id}', [TutorRequestController::class, 'clientShow'])->name('client.tutorRequests.show');
    Route::get('client/tutor-requests/{id}/edit', [TutorRequestController::class, 'clientEdit'])->name('client.tutorRequests.edit');
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

    //Payment Routes
    Route::get('tutor/payments', [PaymentController::class, 'tutorIndex'])->name('tutor.payments.index');
    Route::get('tutor/payments/{id}', [PaymentController::class, 'toturShow'])->name('tutor.payments.show');


});

Route::middleware(['auth', 'can:Admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->middleware(['auth', 'verified'])->name('admin.dashboard');
    //Tutor Request Routes
    Route::get('admin/tutor-requests', [TutorRequestController::class, 'index'])->name('admin.tutorRequests.index');
    Route::get('admin/tutor-requests/{id}', [TutorRequestController::class, 'show'])->name('admin.tutorRequests.show');
    Route::get('admin/tutor-requests/{id}/edit', [TutorRequestController::class, 'edit'])->name('admin.tutorRequests.edit');
    Route::delete('admin/tutor-requests/{id}', [TutorRequestController::class, 'destroy'])->name('admin.tutorRequests.destroy');
    //Bookings
    Route::get('bookings/admin/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::get('bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::get('bookings/admin/all', [BookingController::class, 'allBookings'])->name('bookings.all');

    //Crm Routes
    Route::get('admin/crm', [CrmController::class, 'index'])->name('admin.crm.index');
    Route::get('admin/crm/{id}', [CrmController::class, 'show'])->name('admin.crm.show');
    Route::get('admin/crm/{id}/edit', [CrmController::class, 'edit'])->name('admin.crm.edit');
    Route::delete('admin/crm/{id}', [CrmController::class, 'destroy'])->name('admin.crm.destroy');
    Route::patch('admin/crm/{id}/status', [CrmController::class, 'updateStauts'])->name('admin.crm.updateStatus');

    //Payments Routes
    Route::get('admin/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('admin/payments/create', [PaymentController::class, 'create'])->name('admin.payments.create');
    Route::post('admin/payments', [PaymentController::class, 'store'])->name('admin.payments.store');
    Route::get('admin/payments/{id}', [PaymentController::class, 'show'])->name('admin.payments.show');
    Route::get('admin/payments/{id}/edit', [PaymentController::class, 'edit'])->name('admin.payments.edit');
    Route::put('admin/payments/{id}', [PaymentController::class, 'update'])->name('admin.payments.update');

    //Users Management Routes
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

});

require __DIR__.'/auth.php';
