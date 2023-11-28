<?php

namespace App\Http\Controllers;

use App\Models\Medidor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedidorController extends Controller
{
    public function index()
    {
        $medidores = Medidor::all();
        return response()->json($medidores);
    }

    public function store(Request $request)
    {
        $medidor = Medidor::create($request->all());
        return response()->json($medidor, 201);
    }
}
