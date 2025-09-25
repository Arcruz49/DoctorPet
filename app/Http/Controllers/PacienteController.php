<?php

namespace App\Http\Controllers;

use App\Helpers\SystemHelper;
use App\Models\cadClinica;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\cadPaciente;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PacienteController extends Controller

{
    public function GetPacientes(Request $request){


        $search = $request->query('search');
        $especie = $request->query('especie');
        $order = $request->query('order');
        $exibir = $request->query('exibir');
        $clinica = $request->query('searchClinica');
        // dd($search, $especie, $order, $exibir);

        $query = cadPaciente::query();

        if (!empty($search)) {
            $query->where('nmPaciente', 'like', '%' . $search . '%');
        }
        if (!empty($especie) && $especie != '-1') {
            if($especie == 'c') {
                $query->where('especie', 'dog');
            }
            else if($especie == 'g') {
                $query->where('especie', 'cat');
            }
        }
        if (!empty($clinica) && $clinica != '-1') {
            $query->where('cdClinica', $clinica);
        }
        if ($exibir != '-1' && !empty($exibir)) {
            $query->limit((int)$exibir);
        }
        if ($order === 'recentes') {
            $query->orderBy('dtCriacao', 'desc');
        } elseif ($order === 'antigos') {
            $query->orderBy('dtCriacao', 'asc');
        } elseif ($order === 'nome') {
            $query->orderBy('nmPaciente', 'asc');
        }

        $pacientes = $query->get();
        
        return response()->json($pacientes);
    }

    public function GetPaciente($id){
        $paciente = cadPaciente::where("cdPaciente",$id)->first();

        return response()->json($paciente);
    }


    public function CreatePaciente(Request $request){

        $errorMessage = '';

        if (empty($request->nmPaciente)) $errorMessage .= "Nome inválido<br>";
        if (empty($request->especie))   $errorMessage .= "Espécie inválida<br>";
        if (empty($request->raca))      $errorMessage .= "Raça inválida<br>";
        if (empty($request->idade))     $errorMessage .= "Idade inválida<br>";
        if (empty($request->sexo))      $errorMessage .= "Sexo inválido<br>";
        if (empty($request->peso))      $errorMessage .= "Peso inválido<br>";
        if (empty($request->nmTutor))   $errorMessage .= "Responsável inválido<br>";
        if (empty($request->cdClinica))   $errorMessage .= "Clínica inválida<br>";


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

            $paciente = cadPaciente::create([
                'nmPaciente' => $request->nmPaciente,
                'especie' => $request->especie,
                'raca' => $request->raca,
                'idade' => $request->idade,
                'sexo' => $request->sexo,
                'peso' => $request->peso,
                'nmTutor' => $request->nmTutor,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'endereco' => $request->endereco,
                'obs' => $request->obs,
                'statusVacinacao' => $request->statusVacinacao,
                'cdClinica' => $request->cdClinica,
                'dtCriacao' => now(),

                // Castração e Reprodução
                'castrado' => $request->castrated === 'yes' ? 1 : ($request->castrated === 'no' ? 0 : null),
                'dtCastracao' => $request->castration_date,
                'considerouCastracao' => $request->considered_castration === 'yes' ? 1 : ($request->considered_castration === 'no' ? 0 : null),
                'ciosRegulares' => $request->regular_cycles === 'yes' ? 1 : ($request->regular_cycles === 'no' ? 0 : null),
                'ficouGestante' => $request->pregnant === 'yes' ? 1 : ($request->pregnant === 'no' ? 0 : null),
                'gestacaoPsicologica' => $request->pseudopregnancy === 'yes' ? 1 : ($request->pseudopregnancy === 'no' ? 0 : null),

                // Alimentação
                'tipoAlimentacao' => $request->food_type,
                'tipoAlimentacaoOutro' => $request->food_type_spec,
                'usaSuplemento' => $request->supplements === 'yes' ? 1 : ($request->supplements === 'no' ? 0 : null),
                'tipoSuplemento' => $request->supplements_type,
                'incluiProcessados' => $request->preservatives === 'yes' ? 1 : ($request->preservatives === 'no' ? 0 : null),

                // Ectoparasitas
                'controleEctoparasita' => $request->ectoparasite_control === 'yes' ? 1 : ($request->ectoparasite_control === 'no' ? 0 : null),
                'nomeProdutoEctoparasita' => $request->ectoparasite_product,
                'frequenciaEctoparasita' => $request->ectoparasite_frequency,

                // Vermifugação
                'usoVermifugo' => $request->deworming === 'yes' ? 1 : ($request->deworming === 'no' ? 0 : null),
                'nomeProdutoVermifugo' => $request->deworming_product,
                'frequenciaVermifugo' => $request->deworming_frequency,

                // Vacinação
                'vacinadoAnualmente' => $request->vaccinated === 'yes' ? 1 : ($request->vaccinated === 'no' ? 0 : null),
                'vacinasAplicadas' => $request->vaccines,
                'dataUltimaVacinacao' => $request->last_vaccine_date,
                'vacinacaoEmClinica' => $request->vet_clinic_vaccine === 'yes' ? 1 : ($request->vet_clinic_vaccine === 'no' ? 0 : null),
                'localVacinacao' => $request->vaccine_location,

                // Exposição Solar
                'exposicaoSol' => $request->sun_exposure === 'yes' ? 1 : ($request->sun_exposure === 'no' ? 0 : null),
                'tempoExposicaoSol' => $request->sun_exposure_time,
                'periodoExposicaoSol' => $request->sun_exposure_period,
                'usaProtetorSolar' => $request->sunscreen === 'yes' ? 1 : ($request->sunscreen === 'no' ? 0 : null),
                'tipoProtetorSolar' => $request->sunscreen_type,
                'frequenciaProtetorSolar' => $request->sunscreen_frequency,

                // Acesso à Rua
                'acessoRuaSozinho' => $request->street_access === 'yes' ? 1 : ($request->street_access === 'no' ? 0 : null),
                'tempoAcessoRua' => $request->street_access_time,
                'frequenciaAcessoRua' => $request->street_access_frequency,

                // Produtos Químicos e Poluentes
                'exposicaoQuimicos' => $request->chemical_exposure === 'yes' ? 1 : ($request->chemical_exposure === 'no' ? 0 : null),
                'fumantePassivo' => $request->passive_smoker === 'yes' ? 1 : ($request->passive_smoker === 'no' ? 0 : null),
                'pertoIndustria' => $request->near_industry === 'yes' ? 1 : ($request->near_industry === 'no' ? 0 : null),

                // Contracepção
                'usoInjecaoContraceptiva' => $request->contraceptive_injection === 'yes' ? 1 : ($request->contraceptive_injection === 'no' ? 0 : null),
                'frequenciaInjecaoContraceptiva' => $request->contraceptive_frequency,
                'dataUltimaInjecaoContraceptiva' => $request->last_contraceptive_date,

                // Histórico de Saúde
                'problemaPele' => $request->skin_problems === 'yes' ? 1 : ($request->skin_problems === 'no' ? 0 : null),
                'tipoProblemaPele' => $request->skin_problem_type,
                'recidivaPele' => $request->skin_recurrence === 'yes' ? 1 : ($request->skin_recurrence === 'no' ? 0 : null),
                'possuiDoenca' => $request->has_disease === 'yes' ? 1 : ($request->has_disease === 'no' ? 0 : null),
                'doencaTratada' => $request->disease_treated === 'yes' ? 1 : ($request->disease_treated === 'no' ? 0 : null),
                'respostaTratamento' => $request->treatment_response,
                'medicacaoContinua' => $request->continuous_medication === 'yes' ? 1 : ($request->continuous_medication === 'no' ? 0 : null),
                'tipoMedicacao' => $request->medication_type,
                'inicioMedicacao' => $request->medication_start_date,

                // Exames
                'examesLaboratoriais' => $request->lab_tests === 'yes' ? 1 : ($request->lab_tests === 'no' ? 0 : null),
                'examesImagem' => $request->imaging_tests === 'yes' ? 1 : ($request->imaging_tests === 'no' ? 0 : null),

                // Histórico Familiar
                'historicoCancerFamiliar' => $request->family_cancer_history,


                'color' => $corAleatoria
            ]);

            return response()->json([
                'success'=> true,
                'message'=> 'Paciente cadastrado com sucesso!',
                // 'paciente' => $paciente
            ]) ;

        }
        catch(\Exception $e)
        {
            return response()->json([
                'success'=> false,
                'message'=> 'Erro: ' . $e->getMessage()
            ]) ;
        }
    }

    public function EditPaciente(Request $request){
        $errorMessage = '';

        $paciente = cadPaciente::find($request->cdPaciente);

        if (!$paciente) {
            return response()->json([
                'success' => false,
                'message' => 'Paciente não encontrado.'
            ], 404);
        }

        if (empty($request->nmPaciente)) $errorMessage .= "Nome inválido<br>";
        if (empty($request->especie))   $errorMessage .= "Espécie inválida<br>";
        if (empty($request->raca))      $errorMessage .= "Raça inválida<br>";
        if (empty($request->idade))     $errorMessage .= "Idade inválida<br>";
        if (empty($request->sexo))      $errorMessage .= "Sexo inválido<br>";
        if (empty($request->peso))      $errorMessage .= "Peso inválido<br>";
        if (empty($request->nmTutor))   $errorMessage .= "Responsável inválido<br>";
        if (empty($request->cdClinica))   $errorMessage .= "Clínica inválida<br>";

        if($errorMessage != ""){
            return response()->json([
                "success" => false,
                "message"=> $errorMessage
            ]);
        }

        try
        {
            $paciente->update([
                'nmPaciente' => $request->nmPaciente,
                'especie' => $request->especie,
                'raca' => $request->raca,
                'idade' => $request->idade,
                'sexo' => $request->sexo,
                'peso' => $request->peso,
                'nmTutor' => $request->nmTutor,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'endereco' => $request->endereco,
                'obs' => $request->obs,
                'statusVacinacao' => $request->statusVacinacao,
                'cdClinica' => $request->cdClinica,

                // Castração e Reprodução
                'castrado' => $request->castrated === 'yes' ? 1 : ($request->castrated === 'no' ? 0 : null),
                'dtCastracao' => $request->castration_date,
                'considerouCastracao' => $request->considered_castration === 'yes' ? 1 : ($request->considered_castration === 'no' ? 0 : null),
                'ciosRegulares' => $request->regular_cycles === 'yes' ? 1 : ($request->regular_cycles === 'no' ? 0 : null),
                'ficouGestante' => $request->pregnant === 'yes' ? 1 : ($request->pregnant === 'no' ? 0 : null),
                'gestacaoPsicologica' => $request->pseudopregnancy === 'yes' ? 1 : ($request->pseudopregnancy === 'no' ? 0 : null),

                // Alimentação
                'tipoAlimentacao' => $request->food_type,
                'tipoAlimentacaoOutro' => $request->food_type_spec,
                'usaSuplemento' => $request->supplements === 'yes' ? 1 : ($request->supplements === 'no' ? 0 : null),
                'tipoSuplemento' => $request->supplements_type,
                'incluiProcessados' => $request->preservatives === 'yes' ? 1 : ($request->preservatives === 'no' ? 0 : null),

                // Ectoparasitas
                'controleEctoparasita' => $request->ectoparasite_control === 'yes' ? 1 : ($request->ectoparasite_control === 'no' ? 0 : null),
                'nomeProdutoEctoparasita' => $request->ectoparasite_product,
                'frequenciaEctoparasita' => $request->ectoparasite_frequency,

                // Vermifugação
                'usoVermifugo' => $request->deworming === 'yes' ? 1 : ($request->deworming === 'no' ? 0 : null),
                'nomeProdutoVermifugo' => $request->deworming_product,
                'frequenciaVermifugo' => $request->deworming_frequency,

                // Vacinação
                'vacinadoAnualmente' => $request->vaccinated === 'yes' ? 1 : ($request->vaccinated === 'no' ? 0 : null),
                'vacinasAplicadas' => $request->vaccines,
                'dataUltimaVacinacao' => $request->last_vaccine_date,
                'vacinacaoEmClinica' => $request->vet_clinic_vaccine === 'yes' ? 1 : ($request->vet_clinic_vaccine === 'no' ? 0 : null),
                'localVacinacao' => $request->vaccine_location,

                // Exposição Solar
                'exposicaoSol' => $request->sun_exposure === 'yes' ? 1 : ($request->sun_exposure === 'no' ? 0 : null),
                'tempoExposicaoSol' => $request->sun_exposure_time,
                'periodoExposicaoSol' => $request->sun_exposure_period,
                'usaProtetorSolar' => $request->sunscreen === 'yes' ? 1 : ($request->sunscreen === 'no' ? 0 : null),
                'tipoProtetorSolar' => $request->sunscreen_type,
                'frequenciaProtetorSolar' => $request->sunscreen_frequency,

                // Acesso à Rua
                'acessoRuaSozinho' => $request->street_access === 'yes' ? 1 : ($request->street_access === 'no' ? 0 : null),
                'tempoAcessoRua' => $request->street_access_time,
                'frequenciaAcessoRua' => $request->street_access_frequency,

                // Produtos Químicos e Poluentes
                'exposicaoQuimicos' => $request->chemical_exposure === 'yes' ? 1 : ($request->chemical_exposure === 'no' ? 0 : null),
                'fumantePassivo' => $request->passive_smoker === 'yes' ? 1 : ($request->passive_smoker === 'no' ? 0 : null),
                'pertoIndustria' => $request->near_industry === 'yes' ? 1 : ($request->near_industry === 'no' ? 0 : null),

                // Contracepção
                'usoInjecaoContraceptiva' => $request->contraceptive_injection === 'yes' ? 1 : ($request->contraceptive_injection === 'no' ? 0 : null),
                'frequenciaInjecaoContraceptiva' => $request->contraceptive_frequency,
                'dataUltimaInjecaoContraceptiva' => $request->last_contraceptive_date,

                // Histórico de Saúde
                'problemaPele' => $request->skin_problems === 'yes' ? 1 : ($request->skin_problems === 'no' ? 0 : null),
                'tipoProblemaPele' => $request->skin_problem_type,
                'recidivaPele' => $request->skin_recurrence === 'yes' ? 1 : ($request->skin_recurrence === 'no' ? 0 : null),
                'possuiDoenca' => $request->has_disease === 'yes' ? 1 : ($request->has_disease === 'no' ? 0 : null),
                'doencaTratada' => $request->disease_treated === 'yes' ? 1 : ($request->disease_treated === 'no' ? 0 : null),
                'respostaTratamento' => $request->treatment_response,
                'medicacaoContinua' => $request->continuous_medication === 'yes' ? 1 : ($request->continuous_medication === 'no' ? 0 : null),
                'tipoMedicacao' => $request->medication_type,
                'inicioMedicacao' => $request->medication_start_date,

                // Exames
                'examesLaboratoriais' => $request->lab_tests === 'yes' ? 1 : ($request->lab_tests === 'no' ? 0 : null),
                'examesImagem' => $request->imaging_tests === 'yes' ? 1 : ($request->imaging_tests === 'no' ? 0 : null),

                // Histórico Familiar
                'historicoCancerFamiliar' => $request->family_cancer_history,
            ]);

            return response()->json([
                'success'=> true,
                'message'=> 'Paciente editado com sucesso!',
                // 'paciente' => $paciente
            ]) ;

        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=> false,
                'message'=> 'Erro: ' . $e->getMessage()
            ]) ;
        }
    }

    public function SaveImage(Request $request)
    {
        try {
            // validacoes
            $request->validate([
                'cdPaciente' => 'required|exists:cadPaciente,cdPaciente',
                'imagem' => 'required|file|image',
            ]);

            $paciente = cadPaciente::where("cdPaciente", $request->cdPaciente)->first();
            $clinica = cadClinica::where("cdClinica", $paciente->cdClinica)->first();

            $pacientePath = $this->GetPathPaciente($paciente, $clinica, 'imagem');

            if (!File::exists($pacientePath)) {
                File::makeDirectory($pacientePath, 0755, true);
            }

            $file = $request->file('imagem');
            $fileName = !empty($request->name)
                ? Str::slug($request->name, '_') . '.' . $file->getClientOriginalExtension()
                : $file->getClientOriginalName();

            
            if(systemHelper::verificaSeArquivoJaExiste($fileName, $pacientePath)){
                $fileName = SystemHelper::renomeiaArquivo($fileName, $pacientePath);
            }

            $file->move($pacientePath, $fileName);

            return response()->json([
                'success' => true,
                'message' => 'Imagem salva com sucesso!',
                'path' => $pacientePath . '/' . $fileName
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar imagem: ' . $e->getMessage()
            ]);
        }
    }

    public function saveDocument(Request $request)
    {
        try {
            // validacoes
            $request->validate([
                'cdPaciente' => 'required|exists:cadPaciente,cdPaciente',
                'documento' => 'required|file',
            ]);

            $paciente = cadPaciente::where("cdPaciente", $request->cdPaciente)->first();
            $clinica = cadClinica::where("cdClinica", $paciente->cdClinica)->first();

            $pacientePath = $this->GetPathPaciente($paciente, $clinica, 'documento');

            if (!File::exists($pacientePath)) {
                File::makeDirectory($pacientePath, 0755, true);
            }

            $file = $request->file('documento');
            $fileName = !empty($request->name)
                ? Str::slug($request->name, '_') . '.' . $file->getClientOriginalExtension()
                : $file->getClientOriginalName();

            if(systemHelper::verificaSeArquivoJaExiste($fileName, $pacientePath)){
                $fileName = SystemHelper::renomeiaArquivo($fileName, $pacientePath);
            }
            
            $file->move($pacientePath, $fileName);

            return response()->json([
                'success' => true,
                'message' => 'Documento salvo com sucesso!',
                'path' => $pacientePath . '/' . $fileName
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar o documento: ' . $e->getMessage()
            ]);
        }
    }

    public function GetImagens($id)
    {
        try {
            $paciente = cadPaciente::where('cdPaciente', $id)->first();
            $clinica  = cadClinica::where('cdClinica', $paciente->cdPaciente)->first();
            $path     = $this->GetPathPaciente($paciente, $clinica, 'imagem');

            if (!File::exists($path)) {
                throw new Exception('Caminho não encontrado');
            }

            $imagens = collect(File::files($path))
                ->sortByDesc(fn($file) => filemtime($file)) // mais recentes primeiro
                ->map(fn($file) => [
                    'name'         => $file->getFilename(),
                    'relativePath' => ltrim(str_replace(storage_path('app') . '/', '', $file->getPathname()), '/'),
                ])->values();

            return response()->json([
                'success' => true,
                'data'    => $imagens
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar imagens: ' . $e->getMessage()
            ]);
        }
    }


    public function GetDocumentos($id){
        try{
            $paciente = cadPaciente::where('cdPaciente', $id)->first();
            $clinica = cadClinica::where('cdClinica', $paciente->cdPaciente)->first();
            $path = $this->GetPathPaciente($paciente, $clinica, 'documento');
        
            if (!File::exists($path)) throw new Exception('Caminho não encontrado');
            
            //files = File::files($path);

            $documentos = collect(File::files($path))
            ->sortByDesc(fn($file) => filemtime($file)) 
            ->map(fn($file) => [
                'name'         => $file->getFilename(),
                'relativePath' => ltrim(str_replace(storage_path('app') . '/', '', $file->getPathname()), '/'),
            ])->values();

            return response()->json([
                'success' => true,
                'data' => $documentos
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar documentos: ' . $e->getMessage()
            ]);
        }
    }

    public function GetPathPaciente($paciente, $clinica, $fileType){
        
        $clinicaDir = $clinica->cdClinica . '_' . Str::slug($clinica->nmClinica, '_');
        $pacienteDir = $paciente->cdPaciente . '_' . Str::slug($paciente->nmPaciente, '_') . '_' . Str::slug($paciente->nmTutor, '_');
        $pacientePath = storage_path("app/clinicas/{$clinicaDir}/{$pacienteDir}");

        return $fileType == "imagem" ? $pacientePath . '/imagens' : $pacientePath . '/documentos';
    }


    public function DownloadFile(Request $request)
    {
        try {
            $path = $request->query('path');
            $fullPath = storage_path('app/' . $path);

            if (!file_exists($fullPath)) {
                throw new Exception('Arquivo não encontrado');
            }

            return response()->download($fullPath);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao baixar arquivo: ' . $e->getMessage()
            ], 404);
        }
    }

    



}
