<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class SystemHelper
{
    public static function getPathPaciente($paciente, $clinica, $fileType)
    {
        $clinicaDir = $clinica->cdClinica . '_' . Str::slug($clinica->nmClinica, '_');
        $pacienteDir = $paciente->cdPaciente . '_' . Str::slug($paciente->nmPaciente, '_') . '_' . Str::slug($paciente->nmTutor, '_');
        $pacientePath = storage_path("app/clinicas/{$clinicaDir}/{$pacienteDir}");

        return $fileType === "imagem" ? $pacientePath . '/imagens' : $pacientePath . '/documentos';
    }


    public static function verificaUsuarioLogado(){
        
        $usuario = Auth::user();

        if (!$usuario) {
            // Redireciona para login ou mostra erro
            return redirect()->route('login')->withErrors('Sessão expirada. Faça login novamente.');
        }
    }

    public static function verificaSeArquivoJaExiste($fileName, $path){
        if (!file_exists($path . '/' . $fileName)) return false;
        return true;
    }

    public static function renomeiaArquivo($fileName, $path, $num = 1)
    {
        $info = pathinfo($fileName);
        $nome = $info['filename'];
        $ext  = isset($info['extension']) ? '.' . $info['extension'] : '';

        $novoNome = $nome . "($num)" . $ext;

        if (self::verificaSeArquivoJaExiste($novoNome, $path)) {
            return self::renomeiaArquivo($fileName, $path, $num + 1);
        }

        return $novoNome;
    }

}
