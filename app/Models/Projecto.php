<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'acronimo',
        'fonte_id',
        'valor_orcamental',
        'valor_participante',
        'valor_nao_programado',
        'data_prevista_termino',
        'status',
    ];
    public function participantes(){
        return $this->hasMany(Participante::class);
    }
    public function desembolsos(){
        return $this->hasMany(Desembolso::class);
    }
    public function dispensas(){
        return $this->hasMany(Dispensa::class);
    }
    public function distribuicaoss(){
        return $this->hasMany(Distribuicao::class);
    }
    public function requisicaos(){
        return $this->hasMany(Requisicao::class);
    }

    public function fonte() {
        return $this->belongsTo(Fonte::class, 'fonte_id'); // Verifique se 'fonte_id' é o nome correto da coluna
    }
}
