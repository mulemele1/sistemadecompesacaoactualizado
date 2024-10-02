<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desembolso extends Model
{
    use HasFactory;

    protected $fillable =[
        'gerencia_id',
        'projecto_id',
        'administracao_id',
        'valor',
        'data_desem',
        'status',
    ];
    public function fonte(){
        return $this->belongsTo(Fonte::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
    public function recepcao(){
        return $this->belongsTo(Recepcao::class);
    }
    
}
