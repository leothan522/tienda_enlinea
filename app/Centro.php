<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $table = "centros_cne";
    protected $fillable = ['id_parroquia', 'nombre_centro', 'direccion_centro'];

    public function parroquias(){
        return $this->hasMany('App\Parroquia');
    }

    public function registros(){
        return $this->belongsTo('App\Registro');
    }

}
