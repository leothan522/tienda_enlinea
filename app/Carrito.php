<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = "carrito";
    protected $fillable = ['compras_id', 'ventas_id', 'productos_id', 'cantidad'];

    public function compras(){
        return $this->belongsTo('App\Compra');
    }

    public function ventas(){
        return $this->belongsTo('App\Venta');
    }

    public function productos(){
        return $this->belongsTo('App\Producto');
    }
}
