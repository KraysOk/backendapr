<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Proceso;
use App\Models\Socio;
use App\Models\SocioServicioProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        return response()->json($servicios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio = Servicio::create($request->all());
        return response()->json($servicio, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        return response()->json($servicio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        $servicio->update($request->all());
        return response()->json($servicio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return response()->json(null, 204);
    }


    /**
 * Store a new SocioServicioProceso record.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function storeSocioServicioProceso(Request $request)
{
    // Validar la entrada
    $request->validate([
        'socio_id' => 'required|exists:socios,id',
        'servicio_id' => 'required|exists:servicios,id',
        'proceso_id' => 'required|exists:procesos,id',
        'valor'
    ]);

    // Crear el nuevo registro
    $socioServicioProceso = new SocioServicioProceso([
        'socio_id' => $request->input('socio_id'),
        'servicio_id' => $request->input('servicio_id'),
        'proceso_id' => $request->input('proceso_id'),
        'valor' => $request->input('valor')
    ]);

    $socioServicioProceso->save();

    return response()->json($socioServicioProceso, 201);
}

public function getSocioServicioProceso($socio, $proceso)
{
    // Aquí puedes utilizar el modelo SocioServicioProceso para obtener los registros correspondientes
    $resultados = SocioServicioProceso::where('socio_id', $socio)
                    ->where('proceso_id', $proceso)
                    ->get();

    return response()->json($resultados);
}

public function getServiciosByProcesoAndSocio($procesoId, $socioId)
{
    $proceso = Proceso::find($procesoId);
    $socio = Socio::find($socioId);

    if (!$proceso || !$socio) {
        return response()->json(['error' => 'Proceso o Socio no encontrado'], 404);
    }

    // Consulta manual para obtener los servicios
    $servicios = DB::table('socio_servicio_proceso')
    ->where('proceso_id', $procesoId)
    ->where('socio_id', $socioId)
    ->join('servicios', 'servicios.id', '=', 'socio_servicio_proceso.servicio_id')
    ->select('servicios.*', 'socio_servicio_proceso.valor')
    ->get();

    return response()->json($servicios);
}


}
