<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'plano',
        'status',
        'last_access_at',
    ];

    protected $casts = [
        'last_access_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function radiusUsers()
    {
        return $this->hasMany(RadiusUser::class);
    }
}
