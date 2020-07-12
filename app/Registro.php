<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = "registro_civil";
    protected $fillable = ['nacionalidad', 'cedula', 'primer_apellido', 'segundo_apellido', 'primer_nombre',
                            'segundo_mombre', 'id_centro_cne'];

    public function centros(){
        return $this->hasOne('App\Centro');
    }

}
