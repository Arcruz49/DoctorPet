<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cadPaciente extends Model
{
    protected $table = 'cadPaciente'; 

    protected $primaryKey = 'cdPaciente'; 

    public $timestamps = false; 

    protected $fillable = [
        'nmPaciente',
        'especie',
        'raca',
        'idade',
        'sexo',
        'peso',
        'nmTutor',
        'telefone',
        'email',
        'endereco',
        'obs',
        'statusVacinacao',
        'dtCriacao',
        'imgPaciente',

        // Saúde Reprodutiva
        'castrado',
        'dtCastracao',
        'considerouCastracao',
        'ciosRegulares',
        'ficouGestante',
        'gestacaoPsicologica',

        // Alimentação
        'tipoAlimentacao',
        'tipoAlimentacaoOutro',
        'usaSuplemento',
        'tipoSuplemento',
        'incluiProcessados',

        // Controle de Ectoparasitas
        'controleEctoparasita',
        'nomeProdutoEctoparasita',
        'frequenciaEctoparasita',

        // Vermifugação
        'usoVermifugo',
        'nomeProdutoVermifugo',
        'frequenciaVermifugo',

        // Vacinação
        'vacinadoAnualmente',
        'vacinasAplicadas',
        'dataUltimaVacinacao',
        'vacinacaoEmClinica',
        'localVacinacao',

        // Exposição Solar
        'exposicaoSol',
        'tempoExposicaoSol',
        'periodoExposicaoSol',
        'usaProtetorSolar',
        'tipoProtetorSolar',
        'frequenciaProtetorSolar',

        // Acesso à Rua
        'acessoRuaSozinho',
        'tempoAcessoRua',
        'frequenciaAcessoRua',

        // Produtos Químicos e Poluentes
        'exposicaoQuimicos',
        'fumantePassivo',
        'pertoIndustria',

        // Contracepção
        'usoInjecaoContraceptiva',
        'frequenciaInjecaoContraceptiva',
        'dataUltimaInjecaoContraceptiva',

        // Histórico de Saúde
        'problemaPele',
        'tipoProblemaPele',
        'recidivaPele',
        'possuiDoenca',
        'doencaTratada',
        'respostaTratamento',
        'medicacaoContinua',
        'tipoMedicacao',
        'inicioMedicacao',

        // Exames
        'examesLaboratoriais',
        'examesImagem',

        // Histórico Familiar
        'historicoCancerFamiliar',

        'color',
        'cdClinica',
    ];

    public function clinica()
    {
        return $this->belongsTo(cadClinica::class, 'cdClinica', 'cdClinica');
    }

}
