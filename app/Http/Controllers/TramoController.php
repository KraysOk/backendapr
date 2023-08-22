<?php

namespace App\Http\Controllers;

use App\Models\Tramo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TramoController extends Controller
{
    public function index() {
        return Tramo::all();
    }
    
    public function store(Request $request) {
        $tramo = new Tramo;
        $tramo->inicio = $request->inicio;
        $tramo->fin = $request->fin;
        $tramo->valor = $request->valor;
        $tramo->save();
    
        return response()->json(['message' => 'Tramo creado con éxito', 'tramo' => $tramo], 201);
    }
    
    // Puedes continuar con los métodos update, delete, etc.
    
}
