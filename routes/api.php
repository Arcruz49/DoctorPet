<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::post('/registerUser', [LoginController::class, 'RegisterUser']);
Route::get('/teste', function() {
    return response()->json(['msg' => 'API funcionando']);
});
