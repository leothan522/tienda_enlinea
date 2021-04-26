<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Http\Requests\ProductosRequest;
use App\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productos = Producto::buscar($request->buscar)->where('modalidad', '<>', 'modulo')->orderBy('nombre', 'ASC')->paginate(25);
        $modulos = Producto::where('modalidad', '=', 'modulo')->orderBy('nombre', 'ASC')->get();
        $bolsas = Producto::where('modalidad', '=', 'bolsa')->orderBy('nombre', 'ASC')->first();
        $total = Producto::all()->count();

        if($request->buscar){
            flash('<em>Resultado de la Busqueda Para:</em>
                    <a href="'.route('productos.index').'"><strong><i class="fas fa-tag"></i> '.strtoupper($request->buscar).'</strong></a>', 'primary')->important();
        }

        if (!$bolsas){
            $bolsas = (object) [
                "id" => 0,
                "nombre" => "Precio Bolsa Plastica",
                "precio" => config('app.bolsa')
                ];
        }


        return view('admin.productos.index')
            ->with('productos', $productos)
            ->with('modulos', $modulos)
            ->with('bolsas', $bolsas)
            ->with('total', $total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductosRequest $request)
    {
        //dd($request->all());
        $producto = new Producto($request->all());
        $producto->nombre = strtoupper($request->nombre);
        $producto->save();

        if ($request->modalidad == "bolsa"){
            flash('<strong><i class="fas fa-tag"></i> '.$producto->nombre.'</strong> <em>Modificado Exitosamente</em>', 'success')->important();
        }else{
            flash('<a href="'.route('productos.edit', $producto->id).'"><strong><i class="fas fa-tag"></i> '.$producto->nombre.'</strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        }
        return redirect()->route('productos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $band = $producto->band;
        if ($band == "activo"){
            $producto->band = "inactivo";
        }else{
            $producto->band = "activo";
        }
        $producto->update();

        flash('<a href="'.route('productos.edit', $producto->id).'"><strong><i class="fas fa-tag"></i> '.$producto->nombre.'</strong></a> <em>Editado Exitosamente</em>', 'primary')->important();
        return redirect()->route('productos.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('admin.productos.edit')
            ->with('producto', $producto);
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
        $producto = Producto::find($id);
        $producto->fill($request->all());
        $producto->nombre = strtoupper($request->nombre);
        $producto->update();

        if ($request->modalidad == "bolsa"){
            flash('<strong><i class="fas fa-tag"></i> '.$producto->nombre.'</strong> <em>Modificado Exitosamente</em>', 'primary')->important();
        }else{
            flash('<a href="'.route('productos.edit', $producto->id).'"><strong><i class="fas fa-tag"></i> '.$producto->nombre.'</strong></a> <em>Editado Exitosamente</em>', 'primary')->important();
        }
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $verificar = Carrito::where('productos_id', '=', $id)->first();
        if (!$verificar){
            $producto = Producto::find($id);
            $nombre = $producto->nombre;
            $producto->delete();

            flash('<a href="#"><strong><i class="fas fa-tag"></i> '.$nombre.'</strong></a> <em>Eliminado Exitosamente</em>', 'danger')->important();
            return redirect()->route('productos.index');
        }
    }

    public function create_mod()
    {
        return view('admin.productos.create_mod');
    }

    public function edit_mod($id)
    {
        $producto = Producto::find($id);
        return view('admin.productos.edit_mod')
            ->with('producto', $producto);
    }
}
