<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Exports\PedidosExport;
use App\Exports\Sub01Export;
use App\Exports\Sub01vExport;
use App\Exports\Sub02Export;
use App\Exports\Sub02vExport;
use App\Exports\Sub03Export;
use App\Exports\Sub03vExport;
use App\Exports\Sub04Export;
use App\Exports\Sub04vExport;
use App\Exports\Sub05Export;
use App\Exports\Sub05vExport;
use App\Exports\Sub06Export;
use App\Exports\Sub06vExport;
use App\Llamada;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carbon = new Carbon();
        $total_pedidos = Compra::where('fecha', '=', date('Y-m-d'))->count();
        $total_web = Venta::where('fecha', '=', date('Y-m-d'))->count();
        $total_facturas = Compra::where('fecha', '=', date('Y-m-d'))->where('factura', '<>', null)->count();
        $total_fact_web = Venta::where('fecha', '=', date('Y-m-d'))->where('factura', '<>', null)->count();
        $llamadas = Llamada::where('fecha', '=', date('Y-m-d'))->first();
        if ($llamadas)
        {
            $no_efectivas = $llamadas->costo + $llamadas->recurso + $llamadas->rubro + $llamadas->informacion;
        }else{
            $no_efectivas = 0;
        }

        $total_llamadas = $total_pedidos + $no_efectivas;
        return view('admin.home')
            ->with('carbon', $carbon)
            ->with('pedidos', $total_pedidos)
            ->with('no_efectivas', $no_efectivas)
            ->with('llamadas', $total_llamadas)
            ->with('facturas', $total_facturas)
            ->with('web', $total_web)
            ->with('web_fact', $total_fact_web);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function export_sub01()
    {
        $date = Carbon::now();
        $date->subDay(1);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub01Export(), 'Control_de_llamadas_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub02()
    {
        $date = Carbon::now();
        $date->subDay(2);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub02Export(), 'Control_de_llamadas_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub03()
    {
        $date = Carbon::now();
        $date->subDay(3);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub03Export(), 'Control_de_llamadas_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub04()
    {
        $date = Carbon::now();
        $date->subDay(4);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub04Export(), 'Control_de_llamadas_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub05()
    {
        $date = Carbon::now();
        $date->subDay(5);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub05Export(), 'Control_de_llamadas_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub06()
    {
        $date = Carbon::now();
        $date->subDay(6);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub06Export(), 'Control_de_llamadas_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub01v()
    {
        $date = Carbon::now();
        $date->subDay(1);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub01vExport(), 'Control_de_Pedidos_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub02v()
    {
        $date = Carbon::now();
        $date->subDay(2);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub02vExport(), 'Control_de_Pedidos_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub03v()
    {
        $date = Carbon::now();
        $date->subDay(3);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub03vExport(), 'Control_de_Pedidos_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub04v()
    {
        $date = Carbon::now();
        $date->subDay(4);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub04vExport(), 'Control_de_Pedidos_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub05v()
    {
        $date = Carbon::now();
        $date->subDay(5);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub05vExport(), 'Control_de_Pedidos_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

    public function export_sub06v()
    {
        $date = Carbon::now();
        $date->subDay(6);
        $fecha = $date->toDateString();

        return \Excel::download(new Sub06vExport(), 'Control_de_Pedidos_'.date("d-m-Y", strtotime($fecha)).'.xlsx');
    }

}
