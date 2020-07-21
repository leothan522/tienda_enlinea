<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";
    protected $fillable = ['users_id', 'datos_id', 'modulo_1', 'modulo_2', 'modulo_3', 'modulo_4', 'fecha', 'referencia',
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
	
	public function adicionales(){
        return $this->hasOne('App\Adicional');
    }


}
