<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\TravelOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ColdRoomController;
use App\Http\Controllers\ColdRoomTemperatureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchDensityController;
use App\Http\Controllers\BatchIngredientController;
use App\Http\Controllers\FermenterController;
use App\Http\Controllers\FermenterTemperatureController;

// Rotas de Autenticação (públicas e protegidas)
Route::post('/login', [AuthController::class, 'login']);                  // Login
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']); // Logout
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);          // Dados do usuário autenticado
Route::post('/register', [AuthController::class, 'register']);

// Grupo de rotas protegidas por autenticação JWT
Route::middleware('auth:api')->group(function () {
    Route::post('/travel-orders', [TravelOrderController::class, 'store']);
    Route::put('/travel-orders/{id}/status', [TravelOrderController::class, 'updateStatus']);
    Route::get('/travel-orders/{id}', [TravelOrderController::class, 'show']);
    Route::get('/travel-orders', [TravelOrderController::class, 'index']);
    Route::delete('/travel-orders/{id}', [TravelOrderController::class, 'cancel']);
});
