<?php

namespace App\Http\Controllers;

use App\Models\Proceso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    public function store(Request $request)
    {
        $proceso = Proceso::create($request->all());
        return response()->json($proceso, 201);  // 201 is HTTP code for "Created"
    }

    public function index()
    {
        $procesos = Proceso::with('processtype')->get();
        return response()->json($procesos);
    }

}
