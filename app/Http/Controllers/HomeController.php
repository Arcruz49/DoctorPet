<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $usuario = Auth::user();

        return view('home.index', ['nomeUsuario' => $usuario->nmUsuario]);
    }
}
