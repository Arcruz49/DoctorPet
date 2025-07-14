<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\cadClinica;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index()
    {
        $usuario = Auth::user();

        if (!$usuario) {
            // Redireciona para login ou mostra erro
            return redirect()->route('login')->withErrors('Sessão expirada. Faça login novamente.');
        }

        $usuario->load('perfil');
        $clinicas = cadClinica::all(); // busca todas as clínicas

        return view('home.index', [
            'nomeUsuario' => $usuario->nmUsuario,
            'perfilUsuario' => $usuario->genero == 'M' ? $usuario->perfil->nmPerfil : $usuario->perfil->nmPerfilF,
            'clinicas' => $clinicas
        ]);
    }
}
