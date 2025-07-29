<?php

namespace App\Http\Controllers;

use App\Models\cadClinica;
use App\Models\cadConsulta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


    public function GetConsultas(Request $request){
        DB::statement("SET lc_time_names = 'pt_BR'");

        $dtInicio = $request -> dtConsultaInicio ?? '';
        $dtFim = $request -> dtConsultaFim ?? '';
        $exibir = $request -> exibir ?? 10;
        //dd($dtInicio, $dtFim);
        $query = "
            SELECT 
                a.cdConsulta, 
                a.cdPaciente, 
                b.nmPaciente, 
                b.nmTutor , 
                b.raca, 
                b.especie, 
                a.cdStatusConsulta, 
                DATE_FORMAT(a.dtConsulta, '%H:%i') AS horaConsulta,
                CASE
                    WHEN DATE(a.dtConsulta) = CURDATE() THEN 
                        CONCAT('HOJE, ', UPPER(DATE_FORMAT(a.dtConsulta, '%d de %M de %Y')))
                    WHEN DATE(a.dtConsulta) = CURDATE() + INTERVAL 1 DAY THEN
                        CONCAT('AMANHÃ, ', UPPER(DATE_FORMAT(a.dtConsulta, '%d de %M de %Y')))
                    ELSE 
                        UPPER(DATE_FORMAT(a.dtConsulta, '%d de %M de %Y'))
                END AS dataConsultaExtenso
            FROM cadconsulta a
            LEFT JOIN cadpaciente b ON a.cdPaciente = b.cdPaciente
            WHERE 1 = 1
                AND ('{$dtInicio}' = '' OR DATE(a.dtConsulta) >= '{$dtInicio}')
                AND ('{$dtFim}' = '' OR DATE(a.dtConsulta) <= '{$dtFim}')
            ORDER BY a.dtConsulta;
        ";


        // dd($query);

        $consultas = DB::select($query);

        $consultasAgrupadas = [];

        foreach ($consultas as $c) {
            $data = $c->dataConsultaExtenso;
            $consultasAgrupadas[$data][] = $c;
        }

        //dd($consultasAgrupadas);

        return response()->json($consultasAgrupadas);
    }

    public function CancelarConsulta(Request $request)
    {
        try
        {
            if (empty($request->cdConsulta)) return response()->json(["success" => false, "message" => "Consulta inválida"]);

            $cdConsulta = $request->cdConsulta;

            $consulta = cadConsulta::find($cdConsulta);

            $consulta->update(["cdStatusConsulta" => 4]);

            return response()->json([
                'success'=> true,
                'message'=> 'Consulta cancelada com sucesso!',
            ]) ;

        }
        catch(\Exception $ex)
        {
            return response()->json([
                "success" => false,
                "message"=> $ex->getMessage()
            ]);
        }
    }
}
