<?php

namespace App\Http\Controllers;

use App\Centro;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Registro;
use Illuminate\Http\Request;

class CNEController extends Controller
{
    public function index(){
        $cne = null;
        if(!config('app.cne')){
            return redirect()->route('inicio');
        }
        return view('admin.cne.index')
            ->with('cne', $cne);
    }

    public function buscar(Request $request){
        if(!config('app.cne')){
            return redirect()->route('inicio');
        }
        $cne = Registro::where('cedula', '=', $request->cedula)->first();
        if(!$cne){
            flash('<em>Cedula</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->cedula.' </strong></a> NO Encontrada', 'danger')->important();
        }else{
            $centro = Centro::where('id_centro_cne', '=', $cne->id_centro_cne)->first();
            $cne->centro = $centro->nombre_centro;
            $cne->direccion = $centro->direccion_centro;
            $parroquia = Parroquia::where('id_parroquia', '=', $centro->id_parroquia)->first();
            $cne->parroquia = $parroquia->parroquia;
            $municipio = Municipio::where('id_municipio', '=', $parroquia->id_municipio)->first();
            $cne->municipio = $municipio->municipio;
            $estado = Estado::where('id_estado', '=', $parroquia->id_estado)->first();
            $cne->estado = $estado->estado;
        }
        return view('admin.cne.index')
            ->with('cne', $cne);
    }
}
