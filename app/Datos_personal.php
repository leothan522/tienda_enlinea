<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_personal extends Model
{
    protected $table = "datos_personales";
    protected $fillable = ['users_id', 'cedula', 'nombre_completo', 'telefono', 'direccion', 'municipio'];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function compras(){
        return $this->hasMany('App\Compra');
    }
    public function ventas(){
        return $this->hasMany('App\Venta');
    }

    public static function buscar($name){
        return static::where('cedula', 'LIKE', "%$name%");
    }

}

