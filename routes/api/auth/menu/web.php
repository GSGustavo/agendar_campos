<?php

use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;



Route::controller(MenuController::class)->group(function() {
    // POST
    Route::post("/api/getagendamentos", 'getagendamentos')->name("api.auth.menu.getagendamentos");
    
});

Route::middleware('auth')->group(function () {
    Route::controller(AgendamentosController::class)->group(function() {
        Route::post("/api/getmeusagendamentos", 'getmeusagendamentos')->name("api.auth.menu.getmeusagendamentos");
    });
    Route::controller(MenuController::class)->group(function() {
        // POST
        Route::post("/api/getcampo", 'getcampo')->name("api.auth.menu.getcampo");
    
    });
});



