<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";
    protected $fillable = ['users_id', 'datos_id', 'pedido', 'monto', 'fecha', 'referencia',
        'capture', 'factura', 'estatus', 'municipio', 'responsable'];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function datos(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function carrito(){
        return $this->hasMany('App\Carrito');
    }
}
