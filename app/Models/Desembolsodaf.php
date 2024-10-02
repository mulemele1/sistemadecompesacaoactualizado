<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desembolsodaf extends Model
{
    use HasFactory;
    protected $fillable =[
        'daf_id',
        'projecto_id',
        'administracao_id',
        'valor',
        'data',
        'status',
    ];
    public function gestao(){
        return $this->belongsTo(Gestao::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
    public function administracao(){
        return $this->belongsTo(Administracao::class);
    }
    public function gerencia(){
        return $this->belongsTo(Gerencia::class);
    }
}
