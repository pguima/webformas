<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'vendedor_id',
        'dominio',
        'plataforma',
        'servicos',
        'plano',
        'status',
        'email',
        'servidor',
    ];

    protected $casts = [
        'servicos' => 'array',
    ];

    // Relação com User
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
