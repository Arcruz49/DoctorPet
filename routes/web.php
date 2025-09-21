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
Route::post('/saveImage', [\App\Http\Controllers\PacienteController::class, 'SaveImage'])->name('SaveImage');

// Clínica
Route::get('/Clinicas', [\App\Http\Controllers\ClinicaController::class, 'Index'])->name('Clinicas');
Route::get('/getClinicas', [\App\Http\Controllers\ClinicaController::class, 'GetClinicas'])->name('GetClinicas');
Route::post('/createClinica', [\App\Http\Controllers\ClinicaController::class, 'createClinica'])->name('createClinica');
Route::get('/getClinica/{id}', [\App\Http\Controllers\ClinicaController::class, 'GetClinica'])->name('GetClinica');
Route::post('/editClinica', [\App\Http\Controllers\ClinicaController::class, 'EditClinica'])->name('EditClinica');

//Modelo Documento
Route::get('/Modelos', [\App\Http\Controllers\ModeloDocumentoController::class, 'Index'])->name('Modelos');
Route::get('/getModelos', [\App\Http\Controllers\ModeloDocumentoController::class, 'GetModelos'])->name('GetModelos');
Route::get('/getModelo/{id}', [\App\Http\Controllers\ModeloDocumentoController::class, 'GetModelo'])->name('GetModelo');
Route::post('/createDocumento', [\App\Http\Controllers\ModeloDocumentoController::class, 'CreateDocumento'])->name('CreateDocumento');
Route::post('/editDocumento', [\App\Http\Controllers\ModeloDocumentoController::class, 'EditDocumento'])->name('EditDocumento');

//Consulta
Route::get('/Consultas', [\App\Http\Controllers\ConsultaController::class, 'Index'])->name('Consultas');
Route::post('/createConsulta', [\App\Http\Controllers\ConsultaController::class, 'CreateConsulta'])->name('CreateConsulta');
Route::get('/GetConsultas', [\App\Http\Controllers\ConsultaController::class, 'GetConsultas'])->name('GetConsultas');
Route::post('/CancelarConsulta', [\App\Http\Controllers\ConsultaController::class, 'CancelarConsulta'])->name('CancelarConsulta');
Route::post('/ConfirmarConsulta', [\App\Http\Controllers\ConsultaController::class, 'ConfirmarConsulta'])->name('ConfirmarConsulta');
Route::post('/FinalizarConsulta', [\App\Http\Controllers\ConsultaController::class, 'FinalizarConsulta'])->name('FinalizarConsulta');
Route::post('/FecharConsulta', [\App\Http\Controllers\ConsultaController::class, 'FecharConsulta'])->name('FecharConsulta');
Route::get('/GetDadosConsulta/{id}', [\App\Http\Controllers\ConsultaController::class, 'GetDadosConsulta'])->name('GetDadosConsulta');
Route::post('/GetConsultasPorPaciente', [\App\Http\Controllers\ConsultaController::class, 'GetConsultasPorPaciente'])->name('GetConsultasPorPaciente');