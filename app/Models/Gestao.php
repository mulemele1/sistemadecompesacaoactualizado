<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestao extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Utilize aspas simples para consistência
    ];

    // Adicione outros métodos ou relacionamentos, se necessário
}