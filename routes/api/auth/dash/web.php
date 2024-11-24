<?php

use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth')->group(function () {
    Route::controller(UsersController::class)->group(function() {
        Route::post("/api/getusers", 'getusers')->name("api.auth.dash.getusers");

        // Rota para inativar, ativar, criar, editar usuários
        Route::post("/api/user/operations", 'operation')->name("api.auth.dash.operation");
    });
  
// });



