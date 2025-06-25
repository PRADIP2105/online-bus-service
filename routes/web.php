<?php

use App\Http\Controllers\ScheduleController;
use App\Livewire\SearchSchedules;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedules', SearchSchedules::class)->name('schedules.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
        return 'My Bookings';
    })->name('bookings.index');

    Route::get('/bookings/create/{schedule}', function ($schedule) {
        return 'Book Schedule ' . $schedule;
    })->name('bookings.create');
});