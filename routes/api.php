<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarSalesController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;


// Public routes
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

    Route::apiResource('car-sales', CarSalesController::class);

    Route::get('/available-cars', [CarSalesController::class, 'getAvailableCars']);

    Route::get('/available-cars', [CarController::class, 'index']);
    Route::post('/cars', [CarController::class, 'store']);
    Route::put('/edit-cars/{id}', [CarController::class, 'update']);
    Route::delete('/delete-cars/{id}', [CarController::class, 'destroy']);

    Route::get('/get-reservation-statuses', [ReservationStatusesController::class, 'getReservationStatuses']);
    Route::post('/add-reservation-status', [ReservationStatusesController::class, 'addReservationStatus']);
    Route::put('/edit-reservation-status/{id}', [ReservationStatusesController::class, 'editReservationStatus']);
    Route::delete('/delete-reservation-status/{id}', [ReservationStatusesController::class, 'deleteReservationStatus']);


    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
