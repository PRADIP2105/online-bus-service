<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusController;
use App\Livewire\SearchSchedules;
use App\Livewire\CreateBooking;
use App\Livewire\CreateReview;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [App\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/schedules', SearchSchedules::class)->name('schedules.index');
    Route::get('/reviews/{bus}', CreateReview::class)->name('reviews.index');

    Route::get('/admin/schedules', [ScheduleController::class, 'index'])->name('schedules.manage');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    Route::get('/buses', [BusController::class, 'index'])->name('buses.index');
    Route::get('/buses/create', [BusController::class, 'create'])->name('buses.create');
    Route::post('/buses', [BusController::class, 'store'])->name('buses.store');
    Route::get('/buses/{bus}/edit', [BusController::class, 'edit'])->name('buses.edit');
    Route::put('/buses/{bus}', [BusController::class, 'update'])->name('buses.update');
    Route::delete('/buses/{bus}', [BusController::class, 'destroy'])->name('buses.destroy');

    Route::get('/admin', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');

    Route::get('/bookings', function () {
        return view('bookings.index');
    })->name('bookings.index');

    Route::get('/bookings/create/{schedule}', CreateBooking::class)->name('bookings.create');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
});

Auth::routes(['login' => false, 'logout' => false]);