<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estados";
    protected $fillable = ['estado'];

    public function municipios(){
        return $this->belongsTo('App\Municipio');
    }

    public function parroquias(){
        return $this->belongsTo('App\Parroquia');
    }

}
