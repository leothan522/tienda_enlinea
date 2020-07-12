<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Datos_personal;
use App\Exports\ComprasExport;
use App\Exports\PedidosExport;
use App\Http\Requests\PedidosRequest;
use App\Llamada;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $compras = Compra::where('fecha', '=', date('Y-m-d'))->orderBy('id', 'DESC')->paginate(10);
        $compras->each(function ($compra){
            $compra->datos;
            $compra->users;
        });
        $total = Compra::where('fecha', '=', date('Y-m-d'))->count();
        $llamadas = Llamada::where('fecha', '=', date('Y-m-d'))->first();
        return view('admin.pedidos.index')// admin.pedidos.index
            ->with('compras', $compras)
            ->with('total', $total)
            ->with('llamadas', $llamadas);
       /* return view('admin.export.pedidos')->with('compras', $compras);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pedido.create_cedula');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = Datos_personal::where('cedula', '=', $request->cedula)->first();
        if($datos){
            flash('<em>La Cedula <strong><a href="javascript:history.back()">'.$request->cedula.'</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
            return view('admin.pedidos.edit_cedula')
                ->with('datos', $datos);
        }

        $explode = explode('-', $request->cedula);
        $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
        $cedula = $explode[0].'-'.$numero;

        $datos = Datos_personal::where('cedula', '=', $cedula)->first();
        if($datos){
            flash('<em>La Cedula <strong><a href="javascript:history.back()">'.$request->cedula.'</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
            return view('admin.pedidos.edit_cedula')
                ->with('datos', $datos);
        }

        $datos = new Datos_personal($request->all());
        $datos->cedula = $cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->direccion = strtoupper($request->direccion);
        $datos->municipio = config('app.municipio');
        $datos->save();

        $pedido = new Compra($request->all());
        $pedido->datos_id = $datos->id;
        $pedido->municipio = $request->municipio;
        $pedido->responsable = strtoupper($request->responsable);
        $pedido->save();

        flash('<em>Pedido Guardado para </em> <strong><a href="'.route('pedidos.edit', $pedido->id).'"><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.' </strong></a>', 'success')->important();
        return redirect()->route('pedidos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carbon = new Carbon();
        $compra = Compra::find($id);
        return view('admin.pedidos.show')
            ->with('carbon', $carbon)
            ->with('compra', $compra);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compra = Compra::find($id);
        return view('admin.pedidos.edit')->with('compra', $compra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PedidosRequest $request, $id)
    {
        $datos = Datos_personal::find($request->datos_id);

        if ($request->cedula){

            $explode = explode('-', $request->cedula);
            $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
            $cedula = $explode[0].'-'.$numero;
            $request->cedula = $cedula;

            //dd($cedula);

            if ($datos->cedula != $cedula){
                $verificar = Datos_personal::where('cedula', '=', $cedula)->first();
                //dd($verificar);
                if ($verificar){
                    //$request->cedula = $datos->cedula;
                    flash('<em>La Cedula <strong><a href="#">'.$request->cedula.'</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
                    return redirect()->route( 'pedidos.edit', $id );
                }
            }
            //dd($request->cedula);
            $datos->fill($request->all());
            $datos->cedula = $request->cedula;
            $datos->nombre_completo = strtoupper($request->nombre_completo);
            $datos->direccion = strtoupper($request->direccion);
            //$datos->municipio = 'ROSCIO';
            $datos->update();
        }

        $pedido = Compra::find($id);
        $pedido->fill($request->all());
        $pedido->responsable = strtoupper($request->responsable);

        if ($request->referencia == null){
            $pedido->estatus = "Esperando Pago";
            $pedido->factura = null;
        }

        if ($request->referencia != null && $request->factura != null){
            $pedido->estatus = "Facturado";
        }
        $pedido->update();

        flash('<em>Pedido Modificado para </em> <strong><a href="'.route('pedidos.show', $pedido->id).'"><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.' </strong></a>', 'primary')->important();
        return redirect()->route('pedidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);
        $compra->delete();

        flash('<em>Pedido Eliminado para </em>', 'danger')->important();
        return redirect()->route('pedidos.index');
    }

    public function create_cedula(Request $request)
    {
        $datos = Datos_personal::where('cedula', '=', $request->cedula)->first();
        if (!$datos){

            $explode = explode('-', $request->cedula);
            $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
            $cedula = $explode[0].'-'.$numero;

            $datos2 = Datos_personal::where('cedula', '=', $cedula)->first();
            if($datos2){
                $compra = Compra::where('datos_id', '=', $datos2->id)->where('fecha', date('Y-m-d'))->first();
                if ($compra){
                    flash('<em>Ya existe un pedido para </em><a href="'.route('pedidos.show', $compra->id).'">
                            <strong><i class="fas fa-user"></i> 
                            '.$datos2->nombre_completo.'</strong></a> de HOY', 'warning')->important();
                    return redirect()->route('pedidos.index');
                }else{
                    return view('admin.pedidos.edit_cedula')
                        ->with('datos', $datos2);
                }
            }

            return view('admin.pedidos.create_cedula')
                ->with('cedula', $cedula);

        }else{

            $compra = Compra::where('datos_id', '=', $datos->id)->where('fecha', date('Y-m-d'))->first();
            if ($compra){
                flash('<em>Ya existe un pedido para </em><a href="'.route('pedidos.show', $compra->id).'"><strong><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.'</strong></a> de HOY', 'warning')->important();
                return redirect()->route('pedidos.index');
            }else{
                return view('admin.pedidos.edit_cedula')
                    ->with('datos', $datos);
            }

        }
    }

    public function update_cedula(Request $request, $id)
    {
        $datos = Datos_personal::find($id);

        $explode = explode('-', $request->cedula);
        $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
        $cedula = $explode[0].'-'.$numero;
        $request->cedula = $cedula;

        //dd($cedula);

        if ($datos->cedula != $cedula){
            $verificar = Datos_personal::where('cedula', '=', $cedula)->first();
            //dd($verificar);
            if ($verificar){
                $request->cedula = $datos->cedula;

            }
        }
        //dd($request->cedula);
        $datos->fill($request->all());
        $datos->cedula = $request->cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->direccion = strtoupper($request->direccion);
        //$datos->municipio = 'ROSCIO';
        $datos->update();


        $pedido = new Compra($request->all());
        $pedido->datos_id = $datos->id;
        $pedido->municipio = $request->municipio;
        $pedido->responsable = strtoupper($request->responsable);
        $pedido->save();

        flash('<em>Pedido Guardado para </em> <strong><a href="'.route('pedidos.edit', $pedido->id).'"><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.' </strong></a>', 'success')->important();
        return redirect()->route('pedidos.index');
    }

    public function update_pedido($id)
    {
        $pedido = Compra::find($id);
        $pedido->estatus = 'Despachado';
        $pedido->responsable = strtoupper(auth()->user()->name);
        $pedido->update();

        flash('<em>Despachada la Factura </em><strong><i class="far fa-file-alt"></i> 
                '.$pedido->factura.' </strong>', 'success')->important();
        return redirect()->route('buscar.fecha.get', $pedido->fecha);
    }

    public function store_llamada(Request $request)
    {
        $llamada = new Llamada($request->all());
        $llamada->save();
        return redirect()->route('pedidos.index');
    }

    public function update_llamada(Request $request, $id)
    {
        $llamada = Llamada::find($id);
        $llamada->fill($request->all());
        $llamada->update();
        return redirect()->route('pedidos.index');
    }

    public function export()
    {
        return \Excel::download(new PedidosExport(), 'Control_de_llamadas_'.date('d-m-Y').'.xlsx');
    }
}
