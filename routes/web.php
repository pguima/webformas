<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCrudController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('profile');
    Route::get('/perfil/{id}', [UserController::class, 'viewProfile'])->name('profile.view');

    Route::get('/usuarios', [UserCrudController::class, 'index'])->name('users.index');
    Route::post('/usuarios', [UserCrudController::class, 'store'])->name('users.store');
    Route::put('/usuarios/{id}', [UserCrudController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{id}', [UserCrudController::class, 'destroy'])->name('users.destroy');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});
