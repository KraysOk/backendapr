<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoProcesoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
    
        $tipoProceso = TipoProceso::create($data);
    
        return response()->json($tipoProceso, 201);
    }

}
