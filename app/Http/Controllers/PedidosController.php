<?php

namespace App\Http\Controllers;

use App\Adicional;
use App\Carrito;
use App\Compra;
use App\Datos_personal;
use App\Exports\ComprasExport;
use App\Exports\PedidosExport;
use App\Http\Requests\PedidosRequest;
use App\Llamada;
use App\Producto;
use App\Registro;
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
        $cantidad = null;
        $monto = null;
        $total = null;
        $contador = null;
        $precio_1 = null;
        $rubros_1 = null;
        $precio_2 = null;
        $rubros_2 = null;
        $modulo_1 = null;
        $modulo_2 = null;
        //dd(count($request->productos));
        //dd($request->all());
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

		if($request->modulo_1 != null || $request->modulo_2 != null){

            if ($request->modulo_1 != null){
                $producto = Producto::where( 'nombre' , '=', 'MODULO 01' )->first();
                if ($producto){
                    $precio_1 = $producto->precio;
                    $rubros_1 = $producto->rubros * $request->modulo_1;
                    $modulo_1 = $request->modulo_1 * $precio_1;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $producto->id;
                    $carrito->cantidad     = $request->modulo_1;
                    $carrito->precio     = $producto->precio;
                    $carrito->save();
                }
            }

            if ($request->modulo_2 != null){
                $producto = Producto::where( 'nombre' , '=', 'MODULO 02' )->first();
                if ($producto){
                    $precio_2 = $producto->precio;
                    $rubros_2 = $producto->rubros * $request->modulo_2;
                    $modulo_2 = $request->modulo_2 * $precio_2;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $producto->id;
                    $carrito->cantidad     = $request->modulo_2;
                    $carrito->precio     = $producto->precio;
                    $carrito->save();
                }
            }

            if($request->adicionales) {

                $contador = count( $request->adicionales );

                for ( $i = 0; $i < $contador; $i ++ ) {

                    $cantidad = $cantidad + $request->cant_adicionales[ $i ];
                    $producto = Producto::find( $request->adicionales[ $i ] );
                    $neto     = $request->cant_adicionales[ $i ] * $producto->precio;
                    $monto    = $monto + $neto;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $request->adicionales[ $i ];
                    $carrito->cantidad     = $request->cant_adicionales[ $i ];
                    $carrito->precio       = $producto->precio;
                    $carrito->save();
                }

                $adicionales = new Adicional();
                $adicionales->compras_id = $pedido->id;
                $adicionales->rubros = $cantidad;
                $adicionales->monto = $monto;
                $adicionales->save();

            }

            //$bolsa = config( 'app.bolsa' );
            $total = $modulo_1 + $modulo_2 + $monto;

            $pedido           = Compra::find( $pedido->id );
            $pedido->modulo_4 = $cantidad + $rubros_1 + $rubros_2;
            $pedido->capture  = $total;
            $pedido->update();
		}

        if ($request->modulo_3 != null) {

            $contador = count( $request->productos );

            for ( $i = 0; $i < $contador; $i ++ ) {

                $cantidad = $cantidad + $request->cant[ $i ];
                $producto = Producto::find($request->productos[ $i ]);
                $neto = $request->cant[$i] * $producto->precio;
                $monto = $monto + $neto;

                $carrito               = new Carrito();
                $carrito->compras_id   = $pedido->id;
                $carrito->productos_id = $request->productos[ $i ];
                $carrito->cantidad     = $request->cant[ $i ];
                $carrito->precio     = $producto->precio;
                $carrito->save();
            }

            $bolsa = config('app.bolsa');
            $combo = $request->modulo_3;
            $total = ($combo * $monto) + $bolsa;

            $pedido = Compra::find($pedido->id);
            $pedido->modulo_4 = $cantidad;
            $pedido->capture = $total;
            $pedido->update();
        }

        flash('<em>Pedido Guardado para </em> <strong><a href="'.route('pedidos.show', $pedido->id).'"><i class="fas fa-user"></i> 
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
        $carrito = null;
        $total = null;
		$rubros = null;
		$monto = null;
        $carbon = new Carbon();
        $compra = Compra::find($id);
		$adicionales = Adicional::where('compras_id', '=', $compra->id)->first();
		if($adicionales){
			$rubros = $adicionales->rubros;
			$monto = $adicionales->monto;
		}
        $carrito = Carrito::where('compras_id', '=', $id)->get();
        if ($carrito) {
            $carrito->each( function ( $carrito ) {
                $producto        = Producto::find( $carrito->productos_id );
                $carrito->nombre = $producto->nombre;
                $carrito->neto   = $carrito->cantidad * $carrito->precio;
            } );
        }

        return view('admin.pedidos.show')
            ->with('carbon', $carbon)
            ->with('compra', $compra)
            ->with('rubros', $carrito)
			->with('cantidad', $rubros)
			->with('monto', $monto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$rubros = null;
		$monto = null;
        $productos = Producto::where('band', '=', 'activo')->where('rubros', '=', null)->orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $compra = Compra::find($id);
		$adicionales = Adicional::where('compras_id', '=', $compra->id)->first();
		if($adicionales){
			$rubros = $adicionales->rubros;
			$monto = $adicionales->monto;
		}
        $carrito = Carrito::where('compras_id', '=', $id)->get();
        return view('admin.pedidos.edit')
            ->with('compra', $compra)
            ->with('productos', $productos)
            ->with('rubros', $carrito)
			->with('cantidad', $rubros)
			->with('monto', $monto);
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
        $cantidad = null;
        $monto = null;
        $total = null;
        $contador = null;
        $precio_1 = null;
        $rubros_1 = null;
        $precio_2 = null;
        $rubros_2 = null;
        $modulo_1 = null;
        $modulo_2 = null;

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

		if($request->rubros){

			$db = Adicional::where('compras_id', '=', $pedido->id)->first();
			if($db){
				$adicionales = Adicional::find($db->id);
				$adicionales->fill($request->all());
				//$adicionales->compras_id = $pedido->id;
				$adicionales->update();
			}else{
				$adicionales = new Adicional($request->all());
				$adicionales->compras_id = $pedido->id;
				$adicionales->save();
			}

		}

        if ($request->cedula) {

            $rubros = Carrito::where('compras_id', '=', $pedido->id)->get();
            foreach ($rubros as $rubro){
                $carrito = Carrito::find($rubro->id);
                $carrito->delete();
            }

            if($request->modulo_1 != null || $request->modulo_2 != null){

                if ($request->modulo_1 != null){
                    $producto = Producto::where( 'nombre' , '=', 'MODULO 01' )->first();
                    if ($producto){
                        $precio_1 = $producto->precio;
                        $rubros_1 = $producto->rubros * $request->modulo_1;
                        $modulo_1 = $request->modulo_1 * $precio_1;

                        $carrito               = new Carrito();
                        $carrito->compras_id   = $pedido->id;
                        $carrito->productos_id = $producto->id;
                        $carrito->cantidad     = $request->modulo_1;
                        $carrito->precio     = $producto->precio;
                        $carrito->save();
                    }
                }

                if ($request->modulo_2 != null){
                    $producto = Producto::where( 'nombre' , '=', 'MODULO 02' )->first();
                    if ($producto){
                        $precio_2 = $producto->precio;
                        $rubros_2 = $producto->rubros * $request->modulo_2;
                        $modulo_2 = $request->modulo_2 * $precio_2;

                        $carrito               = new Carrito();
                        $carrito->compras_id   = $pedido->id;
                        $carrito->productos_id = $producto->id;
                        $carrito->cantidad     = $request->modulo_2;
                        $carrito->precio     = $producto->precio;
                        $carrito->save();
                    }
                }

                if($request->adicionales) {

                    $contador = count( $request->adicionales );

                    for ( $i = 0; $i < $contador; $i ++ ) {

                        $cantidad = $cantidad + $request->cant_adicionales[ $i ];
                        $producto = Producto::find( $request->adicionales[ $i ] );
                        $neto     = $request->cant_adicionales[ $i ] * $producto->precio;
                        $monto    = $monto + $neto;

                        $carrito               = new Carrito();
                        $carrito->compras_id   = $pedido->id;
                        $carrito->productos_id = $request->adicionales[ $i ];
                        $carrito->cantidad     = $request->cant_adicionales[ $i ];
                        $carrito->precio       = $producto->precio;
                        $carrito->save();
                    }

                    $adicionales = new Adicional();
                    $adicionales->compras_id = $pedido->id;
                    $adicionales->rubros = $cantidad;
                    $adicionales->monto = $monto;
                    $adicionales->save();

                }

                //$bolsa = config( 'app.bolsa' );
                $total = $modulo_1 + $modulo_2 + $monto;

                $pedido           = Compra::find( $pedido->id );
                $pedido->modulo_4 = $cantidad + $rubros_1 + $rubros_2;
                $pedido->capture  = $total;
                $pedido->update();
            }

            if ($request->modulo_3 != null) {

                $contador = count( $request->productos );

                for ( $i = 0; $i < $contador; $i ++ ) {
                    $cantidad = $cantidad + $request->cant[ $i ];
                    $producto = Producto::find( $request->productos[ $i ] );
                    $neto     = $request->cant[ $i ] * $producto->precio;
                    $monto    = $monto + $neto;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $request->productos[ $i ];
                    $carrito->cantidad     = $request->cant[ $i ];
                    $carrito->precio       = $producto->precio;
                    $carrito->save();
                }

                $bolsa = config( 'app.bolsa' );
                $combo = $request->modulo_3;
                $total = ( $combo * $monto ) + $bolsa;

                $pedido           = Compra::find( $pedido->id );
                $pedido->modulo_4 = $cantidad;
                $pedido->capture  = $total;
                $pedido->update();
            }
        }

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

        flash('<em>Pedido Eliminado </em>', 'danger')->important();
        return redirect()->route('pedidos.index');
    }

    public function create_cedula(Request $request)
    {
        //dd($request->all());
        if ($request->cedula == null){
            flash('No puedes dejar el campo <strong>Cedula</strong> vacio', 'danger')->important();
            return redirect()->route('pedidos.index');
        }
        $cne = null;
        $nombre = null;
        $productos = Producto::where('band', '=', 'activo')->where('rubros', '=', null)->orderBy('nombre', 'ASC')->pluck('nombre', 'id');

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
                        ->with('datos', $datos2)
                        ->with('productos', $productos);
                }
            }

            //CNE
            if(config('app.registro_civil')) {
                $cne = Registro::where( 'cedula', '=', $explode[1] )->first();
                if ( $cne ) {
                    flash( 'Información del CNE', 'info' )->important();
                    $nombre = $cne->primer_nombre . ' ' . $cne->segundo_nombre . ' ' . $cne->primer_apellido . ' ' . $cne->segundo_apellido;
                }
            }



            return view('admin.pedidos.create_cedula')
                ->with('cedula', $cedula)
                ->with('cne', $cne)
                ->with('nombre', $nombre)
                ->with('productos', $productos);

        }else{

            $compra = Compra::where('datos_id', '=', $datos->id)->where('fecha', date('Y-m-d'))->first();
            if ($compra){
                flash('<em>Ya existe un pedido para </em><a href="'.route('pedidos.show', $compra->id).'"><strong><i class="fas fa-user"></i> 
                '.$datos->nombre_completo.'</strong></a> de HOY', 'warning')->important();
                return redirect()->route('pedidos.index');
            }else{
                return view('admin.pedidos.edit_cedula')
                    ->with('datos', $datos)
                    ->with('productos', $productos);
            }

        }
    }

    public function update_cedula(Request $request, $id)
    {
        $cantidad = null;
        $monto = null;
        $total = null;
        $contador = null;
        $precio_1 = null;
        $rubros_1 = null;
        $precio_2 = null;
        $rubros_2 = null;
        $modulo_1 = null;
        $modulo_2 = null;

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

        if($request->modulo_1 != null || $request->modulo_2 != null){

            if ($request->modulo_1 != null){
                $producto = Producto::where( 'nombre' , '=', 'MODULO 01' )->first();
                if ($producto){
                    $precio_1 = $producto->precio;
                    $rubros_1 = $producto->rubros * $request->modulo_1;
                    $modulo_1 = $request->modulo_1 * $precio_1;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $producto->id;
                    $carrito->cantidad     = $request->modulo_1;
                    $carrito->precio     = $producto->precio;
                    $carrito->save();
                }
            }

            if ($request->modulo_2 != null){
                $producto = Producto::where( 'nombre' , '=', 'MODULO 02' )->first();
                if ($producto){
                    $precio_2 = $producto->precio;
                    $rubros_2 = $producto->rubros * $request->modulo_2;
                    $modulo_2 = $request->modulo_2 * $precio_2;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $producto->id;
                    $carrito->cantidad     = $request->modulo_2;
                    $carrito->precio     = $producto->precio;
                    $carrito->save();
                }
            }

            if($request->adicionales) {

                $contador = count( $request->adicionales );

                for ( $i = 0; $i < $contador; $i ++ ) {

                    $cantidad = $cantidad + $request->cant_adicionales[ $i ];
                    $producto = Producto::find( $request->adicionales[ $i ] );
                    $neto     = $request->cant_adicionales[ $i ] * $producto->precio;
                    $monto    = $monto + $neto;

                    $carrito               = new Carrito();
                    $carrito->compras_id   = $pedido->id;
                    $carrito->productos_id = $request->adicionales[ $i ];
                    $carrito->cantidad     = $request->cant_adicionales[ $i ];
                    $carrito->precio       = $producto->precio;
                    $carrito->save();
                }

                $adicionales = new Adicional();
                $adicionales->compras_id = $pedido->id;
                $adicionales->rubros = $cantidad;
                $adicionales->monto = $monto;
                $adicionales->save();

            }

            //$bolsa = config( 'app.bolsa' );
            $total = $modulo_1 + $modulo_2 + $monto;

            $pedido           = Compra::find( $pedido->id );
            $pedido->modulo_4 = $cantidad + $rubros_1 + $rubros_2;
            $pedido->capture  = $total;
            $pedido->update();
        }

        if ($request->modulo_3 != null) {

            $contador = count( $request->productos );

            for ( $i = 0; $i < $contador; $i ++ ) {

                $cantidad = $cantidad + $request->cant[ $i ];
                $producto = Producto::find($request->productos[ $i ]);
                $neto = $request->cant[$i] * $producto->precio;
                $monto = $monto + $neto;

                $carrito               = new Carrito();
                $carrito->compras_id   = $pedido->id;
                $carrito->productos_id = $request->productos[ $i ];
                $carrito->cantidad     = $request->cant[ $i ];
                $carrito->precio     = $producto->precio;
                $carrito->save();
            }

            $bolsa = config('app.bolsa');
            $combo = $request->modulo_3;
            $total = ($combo * $monto) + $bolsa;

            $pedido = Compra::find($pedido->id);
            $pedido->modulo_4 = $cantidad;
            $pedido->capture = $total;
            $pedido->update();
        }

        flash('<em>Pedido Guardado para </em> <strong><a href="'.route('pedidos.show', $pedido->id).'"><i class="fas fa-user"></i> 
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
