<?php

namespace App\Http\Controllers;

use App\Models\Sector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectores = Sector::all();
        return response()->json($sectores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maxId = Sector::max('id');
        $nextId = $maxId ? $maxId + 1 : 1;
        
        echo "max ".$nextId;
        $data = $request->all();
        $data['id'] = $nextId;
    
        $sector = Sector::create($data);
        return response()->json($sector, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sector = Sector::find($id);
    
        if ($sector) {
            $sector->update($request->all());
            return response()->json($sector, 200);
        } else {
            return response()->json(['error' => 'Sector no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sector = Sector::find($id);

        if ($sector) {
            $sector->delete();
            return response()->json(null, 204);  // Devuelve un código 204 (Sin contenido) en caso de éxito.
        } else {
            return response()->json(['error' => 'Sector no encontrado'], 404);
        }
    }
}
