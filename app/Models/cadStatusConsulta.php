<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadStatusConsulta extends Model
{
    // Nome da tabela (opcional se seguir o padrão Laravel)
    protected $table = 'cadStatusConsulta';

    // Chave primária
    protected $primaryKey = 'cdStatusConsulta';

    // Se não quiser timestamps (created_at, updated_at)
    public $timestamps = false;

    // Campos que podem ser atribuídos em massa
    protected $fillable = [
        'descStatusConsulta',
    ];

    // Relacionamento com cadConsulta (1:N)
    public function consultas()
    {
        return $this->hasMany(CadConsulta::class, 'cdStatusConsulta', 'cdStatusConsulta');
    }
}
