<?php

use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;



Route::controller(MenuController::class)->group(function() {
    // POST
    Route::post("/api/getcampo", 'getcampo')->name("api.auth.menu.getcampo");
    Route::post("/api/getagendamentos", 'getagendamentos')->name("api.auth.menu.getagendamentos");
});


