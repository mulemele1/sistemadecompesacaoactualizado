<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administracao extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
    ];
    public function distribuicaos(){
        return $this->hasMany(Distribuicao::class);
    }
    public function requisicaos(){
        return $this->hasMany(Requisicao::class);
    }
}
