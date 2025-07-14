<?php

namespace App\Http\Controllers;
use App\Models\CadModeloDocumento;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ModeloDocumentoController extends Controller
{
    public function Index(){
        
        $usuario = Auth::user();

        if (!$usuario) {
            // Redireciona para login ou mostra erro
            return redirect()->route('login')->withErrors('Sessão expirada. Faça login novamente.');
        }

        $usuario->load('perfil');

        return view('modeloDocumento.index', [
            'nomeUsuario' => $usuario->nmUsuario,
            'perfilUsuario' => $usuario->genero == 'M' ? $usuario->perfil->nmPerfil : $usuario->perfil->nmPerfilF,
            // 'modelos' => $modelos
        ]);
    }

    public function GetModelos(Request $request)
    {
            $search = $request->query('search');
            $especie = $request->query('especie');
            $order = $request->query('order');
            $exibir = $request->query('exibir');
            $query = CadModeloDocumento::query();
        
        if (!empty($search)) {
            $query->where('nmClinica', 'like', '%' . $search . '%');
        }
        if (!empty($especie) && $especie != '-1') {
            if($especie == 'c') {
                $query->where('especie', 'dog');
            }
            else if($especie == 'g') {
                $query->where('especie', 'cat');
            }
        }
        if ($exibir != '-1' && !empty($exibir)) {
            $query->limit((int)$exibir);
        }
        if ($order === 'recentes') {
            $query->orderBy('dtCriacao', 'desc');
        } elseif ($order === 'antigos') {
            $query->orderBy('dtCriacao', 'asc');
        } elseif ($order === 'nome') {
            $query->orderBy('nmClinica', 'asc');
        }

        $clinicas = $query->get();
        
        return response()->json($clinicas);
    }
}
