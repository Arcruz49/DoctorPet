<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cadPerfil extends Model
{
    protected $table = 'cadPerfil';

    protected $primaryKey = 'cdPerfil';

    public $timestamps = false;

    protected $fillable = [
        'nmPerfil',
        'nmPerfilF',
        'dtCriacao',
        'administrador'
    ];
}
