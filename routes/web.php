<?php

use Illuminate\Support\Facades\Route;
// Home
Route::get('/', [\App\Http\Controllers\HomeController::class, 'Index'])->name('Index');

// Login
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'Index'])->name('login');
Route::post('/tryLogin', [\App\Http\Controllers\LoginController::class, 'Login'])->name('Login');
Route::get('/logOut', [\App\Http\Controllers\LoginController::class, 'LogOut'])->name('LogOut');

// Paciente
Route::get('/getPacientes', [\App\Http\Controllers\PacienteController::class, 'GetPacientes'])->name('GetPacientes');
Route::post('/createPaciente', [\App\Http\Controllers\PacienteController::class, 'CreatePaciente'])->name('CreatePaciente');
Route::get('/getPaciente/{id}', [\App\Http\Controllers\PacienteController::class, 'GetPaciente'])->name('GetPaciente');
Route::post('/editPaciente', [\App\Http\Controllers\PacienteController::class, 'EditPaciente'])->name('EditPaciente');

// Clínica
Route::get('/Clinicas', [\App\Http\Controllers\ClinicaController::class, 'Index'])->name('Clinicas');
