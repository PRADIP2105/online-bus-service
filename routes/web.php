<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchBusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/search/bus', [SearchBusController::class, 'index'])->name('search.bus');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::middleware(['role:1|2'])->group(function () {
        Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
        Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
        Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
        Route::get('/admin/schedules', [ScheduleController::class, 'index'])->name('schedules.manage');

        Route::get('/buses', [BusController::class, 'index'])->name('buses.index');
        Route::get('/buses/create', [BusController::class, 'create'])->name('buses.create');
        Route::post('/buses', [BusController::class, 'store'])->name('buses.store');
        Route::get('/buses/{bus}/edit', [BusController::class, 'edit'])->name('buses.edit');
        Route::put('/buses/{bus}', [BusController::class, 'update'])->name('buses.update');
        Route::delete('/buses/{bus}', [BusController::class, 'destroy'])->name('buses.destroy');
    });

    Route::middleware(['role:3'])->group(function () {
        Route::get('/reviews/{bus}', [ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/bookings/create/{schedule}', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    });
});

require __DIR__.'/auth.php';