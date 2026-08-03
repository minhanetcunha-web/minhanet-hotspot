<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiusUser extends Model
{
    protected $fillable = [
        'cliente_id',
        'usuario',
        'plano',
        'mikrotik',
        'status',
        'last_auth_at',
        'tempo_restante',
        'ip_address',
        'mac_address',
    ];

    protected $casts = [
        'last_auth_at' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
