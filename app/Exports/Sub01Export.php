<?php

namespace App\Exports;

use App\Compra;
use App\Llamada;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Sub01Export implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $date = Carbon::now();
        $date->subDay(1);
        $fecha = $date->toDateString();
        //dd($fecha);
        $compras = Compra::where('fecha', '=', $fecha)->orderBy('id', 'ASC')->get();
        $compras->each(function ($compra){
            $compra->datos;
            $compra->users;
        });
        $llamadas = Llamada::where('fecha', '=', $fecha)->first();
        if ($llamadas)
        {
            $costo = $llamadas->costo;
            $recurso = $llamadas->recurso;
            $rubro = $llamadas->rubro;
            $informacion = $llamadas->informacion;
        }else{
            $costo = 0;
            $recurso = 0;
            $rubro = 0;
            $informacion =0;
        }
        return view('admin.export.pedidos', [
            'compras' => $compras,
            'costo' => $costo,
            'recurso' => $recurso,
            'rubro' => $rubro,
            'informacion' => $informacion
        ]);
    }
}
