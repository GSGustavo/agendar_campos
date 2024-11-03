<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;



Route::controller(MenuController::class)->group(function() {
    // GET
    Route::get("/menu", 'index')->name("auth.menu.index");
    // Route::get("/cadastrar/academico", 'manage')->name("academico.cadastrar");
    // Route::get("/editar/academico/{id}", 'manage')->name("academico.editar");

    // POST
    Route::post("/menu/agendamento/save", "save")->name("menu.agendamento.save");
    // Route::post("/alterar/academico", "alter")->name("academico.alterar");
});