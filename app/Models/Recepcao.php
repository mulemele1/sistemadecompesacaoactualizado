<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcao extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
    ];
    public function requisicaos(){
        return $this->hasMany(Requisicao::class);
    }
    public function dispensas(){
        return $this->hasMany(Dispensa::class);
    }
}
