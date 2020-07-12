<?php

namespace App\Exports;

use App\Compra;
use App\Llamada;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PedidosExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $compras = Compra::where('fecha', '=', date('Y-m-d'))->orderBy('id', 'ASC')->get();
        $compras->each(function ($compra){
            $compra->datos;
            $compra->users;
        });
        $llamadas = Llamada::where('fecha', '=', date('Y-m-d'))->first();
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