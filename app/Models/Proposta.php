<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;
    protected $fillable = [
        'descricao',
        'projecto_id',
        'valor_requisicao',
        'data_prop',
        'numero_prop',
        'status',
    ];
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
}
