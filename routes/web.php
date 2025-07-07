<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'Index'])->name('Index');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'Index'])->name('login');
Route::post('/tryLogin', [\App\Http\Controllers\LoginController::class, 'Login'])->name('Login');
Route::get('/logOut', [\App\Http\Controllers\LoginController::class, 'LogOut'])->name('LogOut');

Route::get('/getPacientes', [\App\Http\Controllers\PacienteController::class, 'GetPacientes'])->name('GetPacientes');