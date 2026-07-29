<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
    'plano',
    'valor',
    'payment_id',
    'status',
    'usuario',
    'senha',
    'pago_em',
];
}
