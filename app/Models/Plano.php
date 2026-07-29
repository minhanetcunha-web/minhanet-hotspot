<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'tempo',
        'unidade_tempo',
        'preco',
        'download',
        'upload',
        'simultaneos',
        'status',
        'ativo',
    ];
}