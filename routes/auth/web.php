<?php

use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;



Route::controller(MenuController::class)->group(function() {
    // GET
    Route::get("/menu", 'index')->name("auth.menu.index");
    // Route::get("/cadastrar/academico", 'manage')->name("academico.cadastrar");
    // Route::get("/editar/academico/{id}", 'manage')->name("academico.editar");

    // POST
    Route::post("/menu/agendamento/save", "save")->name("menu.agendamento.save");
    Route::post("/menu/agendamento/destroy", "destroy")->name("menu.agendamento.destroy");
});

Route::controller(AgendamentosController::class)->group(function() {
    Route::get('/agendamentos', 'index')->name("auth.agendamentos.index");
});

require __DIR__.'/../api/auth/menu/web.php';