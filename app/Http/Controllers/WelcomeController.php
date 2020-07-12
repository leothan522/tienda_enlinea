<?php

namespace App\Http\Controllers;

use App\Noticia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $carbon = new Carbon();
        $noticias = Noticia::orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->paginate(10);
        return view('welcome')
            ->with('carbon', $carbon)
            ->with('noticias', $noticias);
    }
}
