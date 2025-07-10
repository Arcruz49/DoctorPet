<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\cadClinica;

use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    public function Index(){
        $usuario = Auth::user();

        return view("clinica.index", ['nomeUsuario' => $usuario->nmUsuario]);
    }

    public function GetClinicas(Request $request){

        $search = $request->query('search');
        $especie = $request->query('especie');
        $order = $request->query('order');
        $exibir = $request->query('exibir');
        // dd($search, $especie, $order, $exibir);

        $query = cadClinica::query();

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

    public function createClinica(Request $request){

        $errorMessage = '';

        if (empty($request->nmClinica)) $errorMessage .= "Nome inválido<br>";

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

            $clinicas = cadClinica::create([
                'nmClinica' => $request->nmClinica,
                'endereco' => $request->endereco,
                'dtCriacao' => now(),
                'color' => $corAleatoria,
                ]); 

            return response()->json([
                "success" => true,
                'message'=> 'Clínica cadastrada com sucesso!',
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

    public function getClinica($id){
        $clinica = cadClinica::where("cdClinica",$id)->first();

        return response()->json($clinica);
    
    }

    public function editClinica(Request $request){
        try
        {
            $errorMessage = '';

            $clinica = cadClinica::find($request->cdClinica);

            if (!$clinica) {
                return response()->json([
                    'success' => false,
                    'message' => 'Clínica não encontrada.'
                ], 404);
            }

            if (empty($request->nmClinica)) $errorMessage .= "Nome inválido<br>";
            

            if($errorMessage != ""){
                return response()->json([
                    "success" => false,
                    "message"=> $errorMessage
                ]);
            }

            $clinica->update([
                'nmClinica' => $request->nmClinica,
                'endereco' => $request->endereco,
            ]);

            return response()->json([
                    "success" => true,
                    "message"=> "Clínica atualizada com sucesso!"
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
