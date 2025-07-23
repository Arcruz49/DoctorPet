<?php

namespace App\Http\Controllers;

use App\Models\cadClinica;
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
        $clinicas = cadClinica::all();

        return view('consulta.index', [
            'nomeUsuario' => $usuario->nmUsuario,
            'perfilUsuario' => $usuario->genero == 'M' ? $usuario->perfil->nmPerfil : $usuario->perfil->nmPerfilF,
            'clinicas' => $clinicas
        ]);
    }

    public function CreateConsulta(Request $request){
        $errorMessage = '';

        if (empty($request->cdPacienteAdicionado)) $errorMessage .= "Paciente inválido<br>";
        if (empty($request->dtConsulta)) $errorMessage .= "Data inválida<br>";


        if($errorMessage != ""){
            return response()->json([
                "success" => false,
                "message"=> $errorMessage
            ]);
        }
        try
        {
            // $cores = ['#FFD6E0', '#C1FBA4', '#7BF1A8', '#90F1EF', '#FFB7FF'];
            // $corAleatoria = $cores[array_rand($cores)];

            $clinicas = cadConsulta::create([
                'cdPaciente' => $request->cdPacienteAdicionado,
                'dtConsulta' => $request->dtConsulta,
                'dtCriacao' => now(),
                'cdStatusConsulta' => 1,
                ]); 

            return response()->json([
                "success" => true,
                'message'=> 'Consulta cadastrada com sucesso!',
            ]);
        }
        catch (\Exception $ex) 
        {
            return response()->json([
                "success" => false,
                "message"=> $ex->getMessage()
            ]);
        }
    }
}
