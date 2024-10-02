<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonte extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
    ];

    public function desembolsos(){
        return $this->hasMany(Desembolso::class);
    }

    public function projectos(){
        return $this->hasMany(Projecto::class);
    }
}
