<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicaocispo extends Model
{
    use HasFactory;
    protected $fillable =[
        'gerencia_id',
        'projecto_id',
        'administracao_id',
        'valor',
    ];
    public function administracao(){
        return $this->belongsTo(Administracao::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
    public function gerencia(){
        return $this->belongsTo(Gerencia::class);
    }
}
