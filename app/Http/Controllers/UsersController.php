<?php

namespace App\Http\Controllers;

use App\Datos_personal;
//use App\Http\Requests\Datos_personalRequest;
use App\Http\Requests\UserRequest;
use App\Representante;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function foo\func;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $usuarios = User::orderBy('id', 'ASC')->paginate(10);
        return view("admin.usuarios.index")
            ->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $clave = $this->generarClave(8);
        return view('admin.usuarios.create')->with('clave', $clave);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;
        $user->save();

        flash('<a href="'.route('usuarios.edit', $user->id).'"><strong><i class="fas fa-user"></i> '.$user->name.'</strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $datos = Datos_personal::where('users_id', '=', $id)->first();

        if($datos){
            $representante = Representante::where('datos_id', $datos->id)->first();
            return view('admin.usuarios.show')
                ->with('datos', $datos)
                ->with('representante', $representante)
                ->with('users_id', $id);
        }else{
            return view('admin.usuarios.datos')->with('users_id', $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $usuario = User::find($id);
        return view('admin.usuarios.edit')->with('usuario', $usuario);
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
        $user = User::find($id);
        $user->fill($request->all());
        $user->update();

        flash('<a href="'.route('usuarios.edit', $user->id).'"><strong><i class="fas fa-user"></i> '.$user->name.'</strong></a> <em>Editado Exitosamente</em>', 'primary')->important();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        flash('<a href="#"><strong><i class="fas fa-user"></i> '.$user->name.'</strong></a> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('usuarios.index');
    }

    public function generarClave($longitud){
        $psswd = substr( md5(microtime()), 1, $longitud);
        return $psswd;
    }

    /*public function datos_store(Datos_personalRequest $request){

        $datos = new Datos_personal();

        $datos->users_id = $request->users_id;
        $datos->cedula = $request->cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->fecha_nac = $request->fecha_nac;
        $datos->telefono = $request->telefono;
        $datos->lugar_nac = $request->lugar_nac;
        if ($request->estudio == null){
            $request->estudio = "NO";
            $request->nombre_estudio = null;
        }
        $datos->estudio = $request->estudio;
        $datos->nombre_estudio = strtoupper($request->nombre_estudio);
        if ($request->trabajo == null){ $request->trabajo = "NO"; }
        $datos->trabajo = $request->trabajo;
        $datos->nombre_trabajo = strtoupper($request->nombre_trabajo);
        $datos->cargo_trabajo = strtoupper($request->cargo_trabajo);
        $datos->pasatiempo = strtoupper($request->pasatiempo);
        if ($request->bautizo == null){ $request->bautizo = "NO"; }
        $datos->bautizo = $request->bautizo;
        if ($request->comunion == null){ $request->comunion = "NO"; }
        $datos->comunion = $request->comunion;
        if ($request->confirmacion == null){ $request->confirmacion = "NO";}
        $datos->confirmacion = $request->confirmacion;
        $datos->parroquia = strtoupper($request->parroquia);
        $datos->arquidiosesis = strtoupper($request->arquidiosesis);
        if ($request->grupo == null){ $request->grupo = "NO";}
        $datos->grupo = $request->grupo;
        $datos->nombre_grupo = strtoupper($request->nombre_grupo);
        $datos->tiempo_grupo = strtoupper($request->tiempo_grupo);
        $datos->practica_grupo = strtoupper($request->practica_grupo);
        $datos->motivo_registro = strtoupper($request->motivo_registro);
        $datos->referencia = strtoupper($request->referencia);
        $datos->sexo = $request->sexo;
        $datos->save();

        $representante = new Representante();

        $representante->datos_id = $datos->id;
        $representante->nombre_representante = strtoupper($request->nombre_representante);
        $representante->telefono_representante = $request->telefono_representante;
        $representante->save();

        flash('<a href="#"><strong><i class="fas fa-user"></i> '.$datos->nombre_completo.'</strong></a> <em>Actualizado Exitosamente</em>', 'primary')->important();
        return redirect()->route('usuarios.index');
    }*/

    /*public function datos_update(Request $request, $id)
    {
        $datos = Datos_personal::find($id);

        $datos->cedula = $request->cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->fecha_nac = $request->fecha_nac;
        $datos->telefono = $request->telefono;
        $datos->lugar_nac = strtoupper($request->lugar_nac);
        if ($request->estudio == null){
            $request->estudio = "NO";
            $request->nombre_estudio = null;
        }
        $datos->estudio = $request->estudio;
        $datos->nombre_estudio = strtoupper($request->nombre_estudio);
        if ($request->trabajo == null){
            $request->trabajo = "NO";
            $request->nombre_trabajo = null;
            $request->cargo_trabajo = null;
        }
        $datos->trabajo = $request->trabajo;
        $datos->nombre_trabajo = strtoupper($request->nombre_trabajo);
        $datos->cargo_trabajo = strtoupper($request->cargo_trabajo);
        $datos->pasatiempo = strtoupper($request->pasatiempo);
        if ($request->bautizo == null){ $request->bautizo = "NO"; }
        $datos->bautizo = $request->bautizo;
        if ($request->comunion == null){ $request->comunion = "NO"; }
        $datos->comunion = $request->comunion;
        if ($request->confirmacion == null){ $request->confirmacion = "NO";}
        $datos->confirmacion = $request->confirmacion;
        $datos->parroquia = strtoupper($request->parroquia);
        $datos->arquidiosesis = strtoupper($request->arquidiosesis);
        if ($request->grupo == null){
            $request->grupo = "NO";
            $request->nombre_grupo = null;
            $request->tiempo_grupo = null;
            $request->practica_grupo = null;
        }
        $datos->grupo = $request->grupo;
        $datos->nombre_grupo = strtoupper($request->nombre_grupo);
        $datos->tiempo_grupo = strtoupper($request->tiempo_grupo);
        $datos->practica_grupo = strtoupper($request->practica_grupo);
        $datos->motivo_registro = strtoupper($request->motivo_registro);
        if ($request->referido == null){
            $request->referencia = null;
        }
        $datos->referencia = strtoupper($request->referencia);
        $datos->sexo = $request->sexo;
        $datos->update();

        $representante = Representante::find($request->id_representante);
        $representante->datos_id = $datos->id;
        $representante->nombre_representante = strtoupper($request->nombre_representante);
        $representante->telefono_representante = $request->telefono_representante;
        $representante->update();

        flash('<a href="'.route('usuarios.show', $datos->users_id).'"><strong><i class="fas fa-user"></i> '.$datos->nombre_completo.'</strong></a> <em>Actualizado Exitosamente</em>', 'primary')->important();
        return redirect()->route('usuarios.index');
        //dd($request->all());
    }*/
}
