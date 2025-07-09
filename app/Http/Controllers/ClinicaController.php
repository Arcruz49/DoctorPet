<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    public function Index(){
        $usuario = Auth::user();

        return view("clinica.index", ['nomeUsuario' => $usuario->nmUsuario]);
    }
}
