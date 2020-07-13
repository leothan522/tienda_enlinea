<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    protected $fillable = ['modalidad', 'nombre', 'precio', 'band'];

    public function carrito(){
        return $this->hasMany('App\Carrito');
    }

    public static function buscar($name){
        return static::where('nombre', 'LIKE', "%$name%");
    }
}
