<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;
use App\Livewire\SearchSchedules;
use App\Livewire\CreateBooking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedules', SearchSchedules::class)->name('schedules.index');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::middleware(['auth', 'role:Admin|Operator'])->group(function () {
    Route::get('/admin/schedules', [ScheduleController::class, 'index'])->name('schedules.manage');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return 'Admin Dashboard';
    })->middleware('role:Admin')->name('admin.dashboard');

    Route::get('/bookings', function () {
        return view('bookings.index');
    })->name('bookings.index');

    Route::get('/bookings/create/{schedule}', CreateBooking::class)->name('bookings.create');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
});