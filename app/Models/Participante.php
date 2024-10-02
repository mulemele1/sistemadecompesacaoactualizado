<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'projecto_id',
    ];
    public function projecto(){
        $this->belongsTo(Projecto::class);
    }
}
