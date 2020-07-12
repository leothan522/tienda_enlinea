<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Llamada extends Model
{
    protected $table = "llamadas";
    protected $fillable = ['fecha', 'costo', 'recurso', 'rubro', 'informacion', 'municipio'];
}
