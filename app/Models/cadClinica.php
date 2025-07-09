<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cadClinica extends Model
{
    protected $table = 'cadClinica';

    protected $primaryKey = 'cdClinica';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'nmClinica',
        'endereco'
    ];
}
