<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\cadClinica;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $usuario = Auth::user()->load('perfil'); 
        $clinicas = cadClinica::all(); // busca todas as clínicas

        return view('home.index', [
            'nomeUsuario' => $usuario->nmUsuario,
            'perfilUsuario' => $usuario->genero == 'M' ? $usuario->perfil->nmPerfil : $usuario->perfil->nmPerfilF,
            'clinicas' => $clinicas
        ]);
    }
}
