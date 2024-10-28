<?php
use Illuminate\Support\Facades\Route;

Route::get("/menu", function() {
    return view("auth.menu.index");
    
})->name('menu');
