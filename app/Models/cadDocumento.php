<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cadDocumento extends Model
{
    protected $table = 'cadDocumento';

    protected $primaryKey = 'cdDocumento'; 

    public $timestamps = false;

    protected $fillable = [
        'cdDocumento',
        'cdPaciente',
        'nmDocumento',
        'dtCriacao',
        'caminho'
    ];

    public function paciente()
    {
        return $this->belongsTo(cadPaciente::class, 'cdPaciente', 'cdPaciente');
    }
}
