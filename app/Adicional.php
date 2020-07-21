<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $table = "adicionales";
	protected $fillable = ['compras_id', 'rubros', 'monto'];
	
	public function compras(){
        return $this->belongsTo('App\Compra');
    }
}
