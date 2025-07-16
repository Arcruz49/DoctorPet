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
            $query->where('nmModeloDocumento', 'like', '%' . $search . '%');
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
            $query->orderBy('nmModeloDocumento', 'asc');
        }

        $clinicas = $query->get();
        
        return response()->json($clinicas);
    }

    public function GetModelo($id){
        $modelo = CadModeloDocumento::where('cdModeloDocumento', $id)->first();
        return response()->json($modelo);
    }

    public function CreateDocumento(Request $request){
         $errorMessage = '';

        if (empty($request->nmModeloDocumento)) $errorMessage .= "Nome inválido<br>";
        if (empty($request->html)) $errorMessage .= "HTML inválido<br>";


        if($errorMessage != ""){
            return response()->json([
                "success" => false,
                "message"=> $errorMessage
            ]);
        }
        try
        {
            $cores = ['#FFD6E0', '#C1FBA4', '#7BF1A8', '#90F1EF', '#FFB7FF'];
            $corAleatoria = $cores[array_rand($cores)];

            $clinicas = CadModeloDocumento::create([
                'nmModeloDocumento' => $request->nmModeloDocumento,
                'descModeloDocumento' => $request->descModeloDocumento,
                'html' => $request->html,
                'dtCriacao' => now(),
                'color' => $corAleatoria,
                ]); 

            return response()->json([
                "success" => true,
                'message'=> 'Modelo cadastrado com sucesso!',
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


    public function EditDocumento(Request $request)
    {
        try
        {
            $errorMessage = '';

            $modelo = CadModeloDocumento::find($request->cdModeloDocumento);

            if (!$modelo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Modelo não encontrado.'
                ], 404);
            }

            if (empty($request->nmModeloDocumento)) $errorMessage .= "Nome inválido<br>";
            if (empty($request->html)) $errorMessage .= "HTML inválido<br>";            

            if($errorMessage != ""){
                return response()->json([
                    "success" => false,
                    "message"=> $errorMessage
                ]);
            }

            $modelo->update([
                'nmModeloDocumento' => $request->nmModeloDocumento,
                'descModeloDocumento' => $request->descModeloDocumento,
                'html' => $request->html,
            ]);

            return response()->json([
                    "success" => true,
                    "message"=> "Modelo atualizado com sucesso!"
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
