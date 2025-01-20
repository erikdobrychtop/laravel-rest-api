<?php

use App\Http\Controllers\BatchController;
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
//Route::middleware('auth:api')->group(function () {
    
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

    // Rotas de Fermentadores
    Route::prefix('fermenters')->group(function () {
        Route::get('/', [FermenterController::class, 'index']);      // Listar todos os fermentadores
        Route::get('/{id}', [FermenterController::class, 'show']);   // Exibir um fermentador específico
        Route::post('/', [FermenterController::class, 'store']);     // Cadastrar um fermentador
        Route::put('/{id}', [FermenterController::class, 'update']); // Atualizar um fermentador
        Route::delete('/{id}', [FermenterController::class, 'destroy']); // Excluir um fermentador
    });

    // Rotas de Temperaturas dos Fermentadores
    Route::prefix('fermenter-temperatures')->group(function () {
        Route::get('/', [FermenterTemperatureController::class, 'index']);      // Listar todas as temperaturas
        Route::get('/{id}', [FermenterTemperatureController::class, 'show']);   // Exibir uma temperatura específica
        Route::post('/', [FermenterTemperatureController::class, 'store']);     // Cadastrar uma temperatura
        Route::put('/{id}', [FermenterTemperatureController::class, 'update']); // Atualizar uma temperatura
        Route::delete('/{id}', [FermenterTemperatureController::class, 'destroy']); // Excluir uma temperatura
    });

    Route::prefix('batches')->group(function () {
        Route::get('/', [BatchController::class, 'index']);
        Route::get('/{id}', [BatchController::class, 'show']);
        Route::post('/', [BatchController::class, 'store']);
        Route::put('/{id}', [BatchController::class, 'update']);
        Route::delete('/{id}', [BatchController::class, 'destroy']);
    
        // Routes for Batch Ingredients
        Route::prefix('/{batchId}/ingredients')->group(function () {
            Route::get('/', [BatchIngredientController::class, 'index']);
            Route::post('/', [BatchIngredientController::class, 'store']);
            Route::put('/{id}', [BatchIngredientController::class, 'update']);
            Route::delete('/{id}', [BatchIngredientController::class, 'destroy']);
        });
    
        // Routes for Batch Densities
        Route::prefix('/{batchId}/densities')->group(function () {
            Route::get('/', [BatchDensityController::class, 'index']);
            Route::post('/', [BatchDensityController::class, 'store']);
            Route::delete('/{id}', [BatchDensityController::class, 'destroy']);
        });
    });

//});
