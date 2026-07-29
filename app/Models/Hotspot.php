<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $fillable = [
        'nome',
        'ip',
        'porta',
        'usuario',
        'senha',
        'nome_hotspot',
        'ativo',
    ];
}
