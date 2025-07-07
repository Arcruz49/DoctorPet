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
    ];
}
