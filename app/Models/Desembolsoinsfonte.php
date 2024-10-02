<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desembolsoinsfonte extends Model
{
    use HasFactory;

    protected $fillable =[
        'fonte_id',
        'projecto_id',
        'daf_id',
        'valor', 
        'data',
        'status',
    ];
    public function fonte(){
        return $this->belongsTo(Fonte::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
    public function gestao(){
        return $this->belongsTo(Gestao::class);
    }
}
