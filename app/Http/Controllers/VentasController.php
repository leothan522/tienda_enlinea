<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Datos_personal;
use App\Exports\FechaExport;
use App\Exports\PedidosExport;
use App\Exports\VentasExport;
use App\Http\Requests\PedidosRequest;
use App\Http\Requests\VentasRequest;
use App\Llamada;
use App\Registro;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $compras = Venta::where('fecha', '=', date('Y-m-d'))->orderBy('id', 'DESC')->paginate(10);
        $compras->each(function ($compra){
            $compra->datos;
            $compra->users;
        });
        $total = Venta::where('fecha', '=', date('Y-m-d'))->count();
        return view('admin.ventas.index')// admin.pedidos.index
        ->with('compras', $compras)
        ->with('total', $total);
        /* return view('admin.export.pedidos')->with('compras', $compras);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            return view('admin.ventas.edit_cedula')
                ->with('datos', $datos);
        }

        $explode = explode('-', $request->cedula);
        $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
        $cedula = $explode[0].'-'.$numero;

        $datos = Datos_personal::where('cedula', '=', $cedula)->first();
        if($datos){
            flash('<em>La Cedula <strong><a href="javascript:history.back()">'.$request->cedula.'</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
            return view('admin.ventas.edit_cedula')
                ->with('datos', $datos);
        }

        $datos = new Datos_personal($request->all());
        $datos->cedula = $cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->direccion = strtoupper($request->direccion);
        $datos->municipio = 'ROSCIO';
        $datos->save();

        $validar = Venta::where('pedido', '=', $request->pedido)->first();
        if($validar){
            flash('<em>El N° Pedido <strong><a href="javascript:history.back()">'.$request->pedido.'</a></strong> ya esta registrado</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
            return view('admin.ventas.edit_cedula')
                ->with('datos', $datos);
        }

        $pedido = new Venta($request->all());
        $pedido->datos_id = $datos->id;
        $pedido->municipio = $request->municipio;
        $pedido->responsable = strtoupper($request->responsable);
        $pedido->save();

        flash('<em>Pedido Guardado para </em> <strong><a href="'.route('ventas.edit', $pedido->id).'"><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.' </strong></a>', 'success')->important();
        return redirect()->route('ventas.index');
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
        $compra = Venta::find($id);
        return view('admin.ventas.show')
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
        $compra = Venta::find($id);
        return view('admin.ventas.edit')->with('compra', $compra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VentasRequest $request, $id)
    {
        $datos = Datos_personal::find($request->datos_id);
        if ($request->cedula) {
            $explode         = explode( '-', $request->cedula );
            $numero          = str_pad( (int) $explode[1], 8, "0", STR_PAD_LEFT );
            $cedula          = $explode[0] . '-' . $numero;
            $request->cedula = $cedula;

            //dd($cedula);

            if ( $datos->cedula != $cedula ) {
                $verificar = Datos_personal::where( 'cedula', '=', $cedula )->first();
                //dd($verificar);
                if ( $verificar ) {
                    //$request->cedula = $datos->cedula;
                    flash('<em>La Cedula <strong><a href="#">'.$request->cedula.'</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
                    return redirect()->route( 'ventas.edit', $id );
                }
            }
            //dd($request->cedula);
            //dd($datos);
            $datos->fill( $request->all() );
            $datos->cedula          = $request->cedula;
            $datos->nombre_completo = strtoupper( $request->nombre_completo );
            $datos->direccion       = strtoupper( $request->direccion );
            //$datos->municipio = 'ROSCIO';
            $datos->update();

        }

        $pedido = Venta::find($id);

        if ($request->pedido) {

            if ( $pedido->pedido != $request->pedido ) {
                $validar = Venta::where( 'pedido', '=', $request->pedido )->first();
                if ( $validar ) {
                    flash( '<em>El N° Pedido <strong><a href="#">' . $request->pedido . '</a></strong> ya esta registrado</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning' )->important();

                    return redirect()->route( 'ventas.edit', $pedido->id );
                }
            }

        }

        $pedido->fill($request->all());
        $pedido->responsable = strtoupper($request->responsable);

        if ($request->referencia == null){
            $pedido->estatus = "Procesando";
            $pedido->factura = null;
        }

        if ($request->referencia != null && $request->factura != null){
            $pedido->estatus = "Facturado";
        }
        $pedido->update();

        flash('<em>Pedido Modificado para </em> <strong><a href="'.route('ventas.show', $pedido->id).'"><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.' </strong></a>', 'primary')->important();
        return redirect()->route('ventas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compra = Venta::find($id);
        $compra->delete();

        flash('<em>Pedido Eliminado para </em>', 'danger')->important();
        return redirect()->route('ventas.index');
    }

    public function create_cedula(Request $request)
    {
        if ($request->cedula == null){
            flash('No puedes dejar el campo <strong>Cedula</strong> vacio', 'danger')->important();
            return redirect()->route('ventas.index');
        }
        $cne = null;
        $nombre = null;
        $datos = Datos_personal::where('cedula', '=', $request->cedula)->first();
        if (!$datos){

            $explode = explode('-', $request->cedula);
            $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
            $cedula = $explode[0].'-'.$numero;

            $datos2 = Datos_personal::where('cedula', '=', $cedula)->first();
            if($datos2){
                $compra = Venta::where('datos_id', '=', $datos2->id)->where('fecha', date('Y-m-d'))->first();
                if ($compra){
                    flash('<em>Ya existe un pedido para </em><a href="'.route('ventas.show', $compra->id).'"><strong><i class="fas fa-user"></i> 
                '.$datos2->nombre_completo.'</strong></a> de HOY', 'warning')->important();
                    //return redirect()->route('pedidos.index');
                }
                return view('admin.ventas.edit_cedula')
                    ->with('datos', $datos2);
            }

            //CNE
            if(config('app.registro_civil')) {
                $cne = Registro::where( 'cedula', '=', $explode[1] )->first();
                if ( $cne ) {
                    flash( 'Información del CNE', 'info' )->important();
                    $nombre = $cne->primer_nombre . ' ' . $cne->segundo_nombre . ' ' . $cne->primer_apellido . ' ' . $cne->segundo_apellido;
                }
            }
            return view('admin.ventas.create_cedula')
                ->with('cedula', $cedula)
                ->with('cne', $cne)
                ->with('nombre', $nombre);
        }else{

            $compra = Venta::where('datos_id', '=', $datos->id)->where('fecha', date('Y-m-d'))->first();
            if ($compra){
                flash('<em>Ya existe un pedido para </em><a href="'.route('ventas.show', $compra->id).'"><strong><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.'</strong></a> de HOY', 'warning')->important();
                //return redirect()->route('ventas.index');
            }

            return view('admin.ventas.edit_cedula')
                ->with('datos', $datos);

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

        $validar = Venta::where('pedido', '=', $request->pedido)->first();
        if($validar){
            flash('<em>El N° Pedido <strong><a href="javascript:history.back()">'.$request->pedido.'</a></strong> ya esta registrado</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
            return view('admin.ventas.edit_cedula')
                ->with('datos', $datos);
        }

        $pedido = new Venta($request->all());
        $pedido->datos_id = $datos->id;
        $pedido->municipio = $request->municipio;
        $pedido->responsable = strtoupper($request->responsable);
        $pedido->save();

        flash('<em>Pedido Guardado para </em> <strong><a href="'.route('ventas.edit', $pedido->id).'"><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.' </strong></a>', 'success')->important();
        return redirect()->route('ventas.index');
    }

    public function update_pedido($id)
    {
        $pedido = Venta::find($id);
        $pedido->estatus = 'Despachado';
        $pedido->responsable = strtoupper(auth()->user()->name);
        $pedido->update();

        flash('<em>Despachada la Factura </em><strong><i class="far fa-file-alt"></i> 
                '.$pedido->factura.' </strong>', 'success')->important();
        return redirect()->route('ventas.buscar.fecha.get', $pedido->fecha);
    }

    public function export()
    {
        return \Excel::download(new VentasExport(), 'Control_de_Pedidos_'.date('d-m-Y').'.xlsx');
    }

}
