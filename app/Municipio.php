<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = "municipios";
    protected $fillable = ['id_estado', 'municipio'];

    public function estados(){
        return $this->hasOne('App\Estado');
    }

    public function parroquias(){
        return $this->belongsTo('App\Parroquia');
    }

}
