<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cadPaciente;

class PacienteController extends Controller
{
    public function GetPacientes(Request $request){
        $pacientes = cadPaciente::select()->all();

        dd($pacientes);
    }
}
