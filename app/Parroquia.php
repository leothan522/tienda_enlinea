<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    protected $table = "parroquias";
    protected $fillable = ['id_estado', 'id_municipio', 'parroquia'];

    public function centros(){
        return $this->belongsTo('App\Centro');
    }

    public function estados(){
        return $this->hasOne('App\Estado');
    }

    public function municipios(){
        return $this->hasOne('App\Municipio');
    }

}
