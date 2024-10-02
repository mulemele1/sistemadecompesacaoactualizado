<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
    use HasFactory;
    protected $fillable =[
        'administracao_id',
        'projecto_id',
        'recepcao_id',
        'valor',
    ];
    public function administracao(){
        return $this->belongsTo(Administracao::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
    public function recepcao(){
        return $this->belongsTo(Recepcao::class);
    }
}
