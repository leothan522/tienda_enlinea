<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Datos_personal;
use App\Http\Requests\Datos_personalRequest;
use App\Venta;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar){
            flash('<em>Resultados para la Cedula <strong><a href="javascript:history.back()">'.$request->buscar.'</a></strong>', 'warning')->important();
        }
        $clientes = Datos_personal::buscar($request->buscar)->orderBy('created_at', 'DESC')->paginate(50);
        $total = Datos_personal::count();
        return view('admin.clientes.index')
                ->with('compras', $clientes)
                ->with('total', $total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Datos_personalRequest $request)
    {
        $explode = explode('-', $request->cedula);
        $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
        $cedula = $explode[0].'-'.$numero;

        $datos = Datos_personal::where('cedula', '=', $cedula)->first();
        if($datos){
            flash('<em>La Cedula <strong><a href="javascript:history.back()">'.$request->cedula.'</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning')->important();
            return view('admin.clientes.edit')
                ->with('datos', $datos);
        }

        $datos = new Datos_personal($request->all());
        $datos->cedula = $cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->direccion = strtoupper($request->direccion);
        $datos->municipio = config('app.municipio');
        $datos->save();

        flash('<em>Cliente guardado</em> <strong><a href="'.route('clientes.edit', $datos->id).'"><i class="fas fa-user"></i>
                '.$datos->nombre_completo.' </strong></a>', 'success')->important();
        return redirect()->route('clientes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos = Datos_personal::find($id);
        return view('admin.clientes.edit')
            ->with('datos', $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = Datos_personal::find($id);

        $explode = explode('-', $request->cedula);
        $numero = str_pad((int)$explode[1], 8, "0", STR_PAD_LEFT);
        $cedula = $explode[0].'-'.$numero;

        if($datos->cedula != $cedula) {
            $datos2 = Datos_personal::where( 'cedula', '=', $cedula )->first();
            if ( $datos2 ) {
                flash( '<em>La Cedula <strong><a href="javascript:history.back()">' . $cedula . '</a></strong> ya esta registrada</em><br>
                    <strong>Verifique bien los datos anten de Continuar</strong>', 'warning' )->important();

                return view( 'admin.clientes.edit' )
                    ->with( 'datos', $datos2 );
            }
        }

        $datos->cedula = $cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->direccion = strtoupper($request->direccion);
        //$datos->municipio = config('app.municipio');
        $datos->update();

        flash('<em>Cliente guardado</em> <strong><a href="'.route('clientes.edit', $datos->id).'"><i class="fas fa-user"></i>
                '.$datos->nombre_completo.' </strong></a>', 'primary')->important();
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = Datos_personal::find($id);
        $nombre = $datos->nombre_completo;
        $pedidos = Compra::where('datos_id', '=', $datos->id)->count();
        $ventas = Venta::where('datos_id', '=', $datos->id)->count();
        $verificar  = $ventas + $pedidos;

        if ($verificar){
            flash('<em>EL Cliente</em> <strong><a href="'.route('clientes.edit', $datos->id).'"><i class="fas fa-user"></i>
                '.$datos->nombre_completo.' </strong></a> <em> <br> <span class="text-bold">NO se puede borrar</span>
                      porque tiene pedidos vinculados</em>', 'warning')->important();
            return redirect()->route('clientes.index');
        }

        $datos->delete();
        flash('<em>Eliminado el Cliente</em> <strong><a href="#"><i class="fas fa-user"></i>
                '.$nombre.' </strong></a> <em>', 'danger')->important();
        return redirect()->route('clientes.index');

    }

    public function buscar(Request $request)
    {
        if ($request->buscar){
            flash('<em>Resultados para el Nombre <strong><a href="javascript:history.back()">'.strtoupper($request->buscar).'</a></strong>', 'warning')->important();
        }
        $clientes = Datos_personal::where("nombre_completo", "LIKE", "%$request->buscar%")->orderBy('created_at', 'DESC')->paginate(50);
        $total = Datos_personal::count();
        return view('admin.clientes.index')
            ->with('compras', $clientes)
            ->with('total', $total);
    }

}
