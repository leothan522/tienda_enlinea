<?php

namespace App\Http\Controllers;

use App\Imports\ComprasImport;
use App\Imports\VentasImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;

class ImportController extends Controller
{
    public function index()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        return view('admin.import.index');
    }

    public function llamadas(Request $request){
        $file = $request->file('excel');
        \Excel::import(new ComprasImport(), $file);

        flash('Importacion de Usuarios Exitosa', 'success')->important();
        return redirect()->route('import.index');
    }

    public function web(Request $request){
        $file = $request->file('excel');
        \Excel::import(new VentasImport(), $file);

        flash('Importacion de Usuarios Exitosa', 'success')->important();
        return redirect()->route('import.index');
    }

}
