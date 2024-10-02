<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desembolsa extends Model
{
    use HasFactory;

    protected $fillable = [
        'fonte_id',      // Chave estrangeira para a tabela fontes
        'projecto_id',   // Chave estrangeira para a tabela projectos
        'daf_id',        // Chave estrangeira para a tabela das de alguma forma
        'valor',         // Valor do desembolso
        'data_desem',    // Data do desembolso
        'status',        // Status do desembolso
    ];

    public function fonte()
    {
        return $this->belongsTo(Fonte::class);
    }

    public function projecto()
    {
        return $this->belongsTo(Projecto::class);
    }

    public function gestao()
    {
        return $this->belongsTo(Gestao::class);
    }
}
