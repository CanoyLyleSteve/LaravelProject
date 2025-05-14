<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarSalesController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;


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

    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/add-reservations', [ReservationController::class, 'store']);
    Route::put('/edit-reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/delete-reservations/{id}', [ReservationController::class, 'destroy']);


    Route::get('/get-roles', [RoleController::class, 'index']);          
    Route::post('/add-role', [RoleController::class, 'store']);        
    Route::get('/search-role/{id}', [RoleController::class, 'show']);     
    Route::put('/edit-role/{id}', [RoleController::class, 'update']);    
    Route::delete('/delete-role/{id}', [RoleController::class, 'destroy']); 
    
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
