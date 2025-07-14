<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadModeloDocumento extends Model
{
    protected $table = 'cadModeloDocumento';

    protected $primaryKey = 'cdModeloDocumento';

    public $timestamps = false; 

    protected $fillable = [
        'nmModeloDocumento',
        'html',
        'dtCriacao',
        'color',
        'descModeloDocumento'
    ];
}
