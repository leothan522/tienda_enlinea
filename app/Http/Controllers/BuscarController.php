<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Datos_personal;
use App\Http\Requests\PedidosRequest;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function cedula(Request $request)
    {
        $busqueda = Datos_personal::where('cedula', '=', $request->buscar)->first();

        if($busqueda)
        {
            //dd($busqueda->id);
            $carbon = new Carbon();
            $compras = Compra::where('datos_id', '=', $busqueda->id)->orderBy('id', 'DESC')->paginate(10);
            $compras->each(function ($compra){
                $compra->datos;
                $compra->users;
            });
            flash('<em>Resultados para la Cedula</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.index')
                ->with('carbon', $carbon)
                ->with('compras', $compras);

        }else{
            flash('<em>Sin Resultados para la Cedula</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'warning')->important();
            return redirect()->route('pedidos.index');
        }
    }

    public function referencia(Request $request)
    {
        $busqueda = Compra::where('referencia', '=', $request->buscar)->first();
        if($busqueda)
        {
            $carbon = new Carbon();
            flash('<em>Resultados para la Referencia</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.referencia')
                ->with('carbon', $carbon)
                ->with('compra', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Referencia</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'warning')->important();
            return redirect()->route('pedidos.index');
        }

    }

    public function factura(Request $request)
    {
        $busqueda = Compra::where('factura', '=', $request->buscar)->first();
        if($busqueda)
        {
            $carbon = new Carbon();
            flash('<em>Resultados para la Factura</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.referencia')
                ->with('carbon', $carbon)
                ->with('compra', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Factura</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'warning')->important();
            return redirect()->route('pedidos.index');
        }

    }


    public function cedula_ventas(Request $request)
    {
        $busqueda = Datos_personal::where('cedula', '=', $request->buscar)->first();

        if($busqueda)
        {
            //dd($busqueda->id);
            $carbon = new Carbon();
            $compras = Venta::where('datos_id', '=', $busqueda->id)->orderBy('id', 'DESC')->paginate(10);
            $compras->each(function ($compra){
                $compra->datos;
                $compra->users;
            });
            flash('<em>Resultados para la Cedula</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.ventas')
                ->with('carbon', $carbon)
                ->with('compras', $compras);

        }else{
            flash('<em>Sin Resultados para la Cedula</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'danger')->important();
            return redirect()->route('ventas.index');
        }
    }

    public function referencia_ventas(Request $request)
    {
        $busqueda = Venta::where('referencia', '=', $request->buscar)->first();
        if($busqueda)
        {
            $carbon = new Carbon();
            flash('<em>Resultados para la Referencia</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.factura')
                ->with('carbon', $carbon)
                ->with('compra', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Referencia</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'danger')->important();
            return redirect()->route('ventas.index');
        }

    }


    public function factura_ventas(Request $request)
    {
        $busqueda = Venta::where('factura', '=', $request->buscar)->first();
        if($busqueda)
        {
            $carbon = new Carbon();
            flash('<em>Resultados para la Factura</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.factura')
                ->with('carbon', $carbon)
                ->with('compra', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Factura</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'danger')->important();
            return redirect()->route('ventas.index');
        }

    }

    public function pedidos(Request $request)
    {
        $busqueda = Venta::where('pedido', '=', $request->buscar)->paginate(10);
        if(!$busqueda->isEmpty())
        {
            $carbon = new Carbon();
            flash('<em>Resultados para el Pedido</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'primary')->important();
            return view('admin.buscar.ventas')
                ->with('carbon', $carbon)
                ->with('compras', $busqueda);
        }else{
            flash('<em>Sin Resultados para el Pedido</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'danger')->important();
            return redirect()->route('ventas.index');
        }

    }

    public function fecha(Request $request)
    {
        $carbon = new Carbon();
        $busqueda = Compra::where('fecha', '=', $request->buscar)->get();
        if(!$busqueda->isEmpty())
        {
            flash('<em>Resultados para la Fecha</em> <strong><i class="fas fa-search"></i> 
                '.$carbon->parse($request->buscar)->format('d-m-Y').' </strong>', 'primary')->important();
            return view('admin.buscar.index')
                ->with('carbon', $carbon)
                ->with('compras', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Fecha</em> <strong><i class="fas fa-search"></i> 
                '.$carbon->parse($request->buscar)->format('d-m-Y').' </strong>', 'warning')->important();
            return redirect()->route('pedidos.index');
        }

    }

    public function fecha_get($fecha)
    {
        $busqueda = Compra::where('fecha', '=', $fecha)->get();
        if(!$busqueda->isEmpty())
        {
            $carbon = new Carbon();
            /*flash('<em>Resultados para la Fecha</em> <strong><a href="#"><i class="fas fa-search"></i>
                '.$carbon->parse($fecha)->format('d-m-Y').' </strong></a>', 'info')->important();*/
            return view('admin.buscar.index')
                ->with('carbon', $carbon)
                ->with('compras', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Fecha</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'warning')->important();
            return redirect()->route('pedidos.index');
        }

    }

    public function ven_fecha(Request $request)
    {
        $carbon = new Carbon();
        $busqueda = Venta::where('fecha', '=', $request->buscar)->get();
        if(!$busqueda->isEmpty())
        {
            flash('<em>Resultados para la Fecha</em> <strong><i class="fas fa-search"></i> 
                '.$carbon->parse($request->buscar)->format('d-m-Y').' </strong>', 'primary')->important();
            return view('admin.buscar.ventas')
                ->with('carbon', $carbon)
                ->with('compras', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Fecha</em> <strong><i class="fas fa-search"></i> 
                '.$carbon->parse($request->buscar)->format('d-m-Y').' </strong>', 'danger')->important();
            return redirect()->route('ventas.index');
        }

    }

    public function ven_fecha_get($fecha)
    {
        $busqueda = Venta::where('fecha', '=', $fecha)->get();
        if(!$busqueda->isEmpty())
        {
            $carbon = new Carbon();
            /*flash('<em>Resultados para la Fecha</em> <strong><a href="#"><i class="fas fa-search"></i>
                '.$carbon->parse($fecha)->format('d-m-Y').' </strong></a>', 'info')->important();*/
            return view('admin.buscar.ventas')
                ->with('carbon', $carbon)
                ->with('compras', $busqueda);
        }else{
            flash('<em>Sin Resultados para la Fecha</em> <strong><a href="#"><i class="fas fa-search"></i> 
                '.$request->buscar.' </strong></a>', 'warning')->important();
            return redirect()->route('ventas.index');
        }

    }



}
