<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'imagemPerfil'
    ];
}
