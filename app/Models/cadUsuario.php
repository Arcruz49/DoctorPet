<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\cadPerfil;

class cadUsuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'cadUsuario';

    protected $primaryKey = 'cdUsuario';

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'nmUsuario',
        'login',
        'senha',
        'imagemPerfil',
        'genero',
        'dtCriacao',
        'cdPerfil'
    ];

    public function perfil()
    {
        return $this->belongsTo(cadPerfil::class, 'cdPerfil', 'cdPerfil');
    }
}
