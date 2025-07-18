<?php

namespace App\Http\Controllers;
use App\Models\cadConsulta;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function Index(){
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->withErrors('Sessão expirada. Faça login novamente.');
        }

        $usuario->load('perfil');
        $consultas = cadConsulta::all();

        return view('consulta.index', [
            'nomeUsuario' => $usuario->nmUsuario,
            'perfilUsuario' => $usuario->genero == 'M' ? $usuario->perfil->nmPerfil : $usuario->perfil->nmPerfilF,
            'consultas' => $consultas
        ]);
    }
}
