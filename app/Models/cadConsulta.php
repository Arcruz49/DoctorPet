<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cadConsulta extends Model
{
    protected $table = 'cadConsulta';

    protected $primaryKey = 'cdConsulta'; 

    public $timestamps = false;

    protected $fillable = [
        'cdPaciente',
        'dtConsulta',
        'dtCriacao',
        'queixaPrincipal',
        'inicio',
        'preogressao',
        'sinais',
        'medidas',
        'obs',
        'examesSolicitados',
        'sugestoes',
        'prescricoes',
        'objetivos',
        'cdStatusConsulta'
    ];

    public function paciente()
    {
        return $this->belongsTo(cadPaciente::class, 'cdPaciente', 'cdPaciente');
    }
    public function status()
    {
        return $this->belongsTo(CadStatusConsulta::class, 'cdStatusConsulta', 'cdStatusConsulta');
    }

}
