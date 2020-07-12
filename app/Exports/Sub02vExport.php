<?php

namespace App\Exports;

use App\Venta;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Sub02vExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $date = Carbon::now();
        $date->subDay(2);
        $fecha = $date->toDateString();
        //dd($fecha);
        $compras = Venta::where('fecha', '=', $fecha)->orderBy('id', 'ASC')->get();
        $compras->each(function ($compra){
            $compra->datos;
            $compra->users;
        });
        return view('admin.export.ventas', [
            'compras' => $compras
        ]);
    }
}
