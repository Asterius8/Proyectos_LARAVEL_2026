<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// ── Página de inicio ────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ── Rutas de autenticación ──────────────────────────────────
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ── Rutas protegidas (requieren login) ──────────────────────
Route::middleware('auth')->group(function () {
    Route::resource('alumnos', AlumnoController::class);
});