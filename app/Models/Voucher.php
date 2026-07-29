<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'codigo',
        'perfil',
        'valor',
        'status',
        'cliente_ip',
        'mac',
        'hotspot_id',
    ];

    public function hotspot()
    {
        return $this->belongsTo(Hotspot::class);
    }
}