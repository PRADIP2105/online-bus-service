<?php

use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
});