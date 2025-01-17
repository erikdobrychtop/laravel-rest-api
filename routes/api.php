<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ColdRoomController;
use App\Http\Controllers\ColdRoomTemperatureController;
use App\Http\Controllers\AuthController;

// Rotas de Autenticação (públicas e protegidas)
Route::post('/login', [AuthController::class, 'login']);                  // Login
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']); // Logout
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);          // Dados do usuário autenticado

// Grupo de rotas protegidas por autenticação JWT
Route::middleware('auth:api')->group(function () {
    
    // Rotas de Cervejarias
    Route::prefix('breweries')->group(function () {
        Route::get('/', [BreweryController::class, 'index']);      // Listar todas as cervejarias
        Route::get('/{id}', [BreweryController::class, 'show']);   // Exibir uma cervejaria específica
        Route::post('/', [BreweryController::class, 'store']);     // Cadastrar uma cervejaria
        Route::put('/{id}', [BreweryController::class, 'update']); // Atualizar uma cervejaria
        Route::delete('/{id}', [BreweryController::class, 'destroy']); // Excluir uma cervejaria
    });
    
    // Rotas de Câmaras Frias
    Route::prefix('cold-rooms')->group(function () {
        Route::get('/', [ColdRoomController::class, 'index']);      // Listar todas as câmaras frias
        Route::get('/{id}', [ColdRoomController::class, 'show']);   // Exibir uma câmara fria específica
        Route::post('/', [ColdRoomController::class, 'store']);     // Cadastrar uma câmara fria
        Route::put('/{id}', [ColdRoomController::class, 'update']); // Atualizar uma câmara fria
        Route::delete('/{id}', [ColdRoomController::class, 'destroy']); // Excluir uma câmara fria
    });
    
    // Rotas de Temperaturas das Câmaras Frias
    Route::prefix('cold-room-temperatures')->group(function () {
        Route::get('/', [ColdRoomTemperatureController::class, 'index']);      // Listar todas as temperaturas
        Route::get('/{id}', [ColdRoomTemperatureController::class, 'show']);   // Exibir uma temperatura específica
        Route::post('/', [ColdRoomTemperatureController::class, 'store']);     // Registrar uma nova temperatura
        Route::put('/{id}', [ColdRoomTemperatureController::class, 'update']); // Atualizar uma temperatura
        Route::delete('/{id}', [ColdRoomTemperatureController::class, 'destroy']); // Excluir uma temperatura
    });
});
