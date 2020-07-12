<?php

namespace App\Exports;

use App\Venta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VentasExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $compras = Venta::where('fecha', '=', date('Y-m-d'))->orderBy('id', 'ASC')->get();
        $compras->each(function ($compra){
            $compra->datos;
            $compra->users;
        });
        return view('admin.export.ventas', [
            'compras' => $compras
        ]);
    }
}
