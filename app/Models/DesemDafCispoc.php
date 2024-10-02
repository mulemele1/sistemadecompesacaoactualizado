<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesemDafCispoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_cispoc',
        'usuario',
        'valor',
        'comentario',
        'status',
    ];
}
