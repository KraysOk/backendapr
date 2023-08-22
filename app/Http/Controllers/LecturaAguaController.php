<?php

namespace App\Http\Controllers;

use App\Models\LecturaAgua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LecturaAguaController extends Controller
{
// LecturaController.php
    public function store(Request $request) {
        $data = $request->validate([
            'proceso_id' => 'required|exists:procesos,id',
            'socio_id' => 'required|exists:socios,id',
            'consumption_value' => 'required|numeric'
        ]);
        $lectura = LecturaAgua::create($data);
        return response()->json($lectura, 201);
    }

    // Función para obtener la lectura de agua de un socio para un proceso
    public function getLecturaBySocioAndProceso($socio_id, $proceso_id) {
        $lectura = LecturaAgua::where('socio_id', $socio_id)
                                ->where('proceso_id', $proceso_id)
                                ->first();

        if (!$lectura) {
            return response()->json(['message' => 'Lectura no encontrada'], 404);
        }

        return response()->json($lectura, 200);
    }
}
