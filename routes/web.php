<?php

use App\Http\Controllers\CamposController;
use App\Http\Controllers\DashAgendamentosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;




Route::domain(env('SESSION_DOMAIN'))->group(function() {
    Route::controller(IndexController::class)->group(function() {
        Route::get("/", "index")->name("index.projeto");
    });

    Route::post('/api/resetpassword', [UsersController::class, 'operation'])->name("api.auth.admin.resetpassword");
   
});

require __DIR__.'/auth.php';

Route::domain("dash." . env('SESSION_DOMAIN'))->group(function() {
    Route::controller(DashboardController::class)->group(function() {
        Route::get("/", 'index')->name("dashboard.index");
       
    });

    Route::controller(UsersController::class)->group(function() {
        Route::get("/users", 'index')->name("users.index");
    });

    Route::controller(CamposController::class)->group(function() {
        Route::get("/campos", 'index')->name("campos.index");
    });

    Route::controller(DashAgendamentosController::class)->group(function() {
        Route::get("/agendamentos", 'index')->name("agendamentos.index");
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    require __DIR__.'/auth/web.php';
});




require __DIR__.'/api/auth/menu/web.php';
require __DIR__.'/api/auth/dash/web.php';