<?php

use App\Http\Controllers\PruebaController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Nuestras rutas
Route::get('/admin/saludo', [PruebaController::class, "index"]);//->middleware("auth");
