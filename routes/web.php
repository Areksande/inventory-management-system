<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;


Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');

Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');