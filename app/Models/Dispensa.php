<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Dispensa extends Model
{
    use HasFactory;
    protected $fillable = [
        'recepcao_id',
        'projecto_id',
        'participante_id',
        'valor',
        'valor_variavel',
        'motivo',
        'visita',
        'valor_esp',
        'motivo_esp',
        'data_visita',
    ];
    public function recepcao(){
        return $this->belongsTo(Recepcao::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
    public function participante(){
        return $this->belongsTo(Participante::class);
    }
}
