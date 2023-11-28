<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use App\Models\Medidor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SocioController extends Controller
{
    public function index()
    {
        $socios = Socio::all(); // Obtén todos los socios
        $socios = Socio::with('sector')->get();
        return response()->json($socios, 200); // Devuelve los socios en formato JSON
    }

    public function store(Request $request)
    {
        $socio = Socio::create($request->all());

        return response()->json($socio, 201);
    }

    public function destroy($id)
{
    $socio = Socio::find($id);

    if ($socio) {
        $socio->delete();
        return response()->json(null, 204);  // Devuelve un código 204 (Sin contenido) en caso de éxito.
    } else {
        return response()->json(['error' => 'Socio no encontrado'], 404);
    }
}

public function getSocios($proceso) {
    $procesoId = $proceso;

    // Consulta para obtener socios y su respectiva lectura de agua para un proceso específico.
    $socios = Socio::with(['lecturasDeAgua' => function($query) use ($procesoId) {
        $query->where('proceso_id', $procesoId);
    }])
    ->get();

    // Procesa cada socio para "aplanar" la respuesta y agregar el campo consumo y costo.
    $sociosTransformed = $socios->map(function($socio) use ($procesoId) {
        $lecturas = $socio->lecturasDeAgua;
        
        $socio->costo = 0;  // Inicializa el costo en 0 para que podamos sumar los valores adicionales después

        // Inicializar los cargos
        $socio->cargoFijo = 0;
        $socio->otrosPagos = 0;

        if ($lecturas->count() > 0) {
            $socio->consumo = $lecturas->first()->consumption_value;

            // Determina en qué tramo cae el consumo y obtiene el precio por litro
            $tramo = DB::table('tramos')
                ->where('inicio', '<=', $socio->consumo)
                ->where('fin', '>=', $socio->consumo)
                ->first();

            if ($tramo) {
                $socio->costo += $socio->consumo * $tramo->valor;
                $socio->cargo_consumo = $socio->costo ;
            }

            // Obtener el cargo fijo (servicio_id = 1) y otros cargos (servicio_id = 6) para este socio en el proceso específico
            $cargoFijo = DB::table('socio_servicio_proceso')
                ->where('socio_id', $socio->id)
                ->where('proceso_id', $procesoId)
                ->where('servicio_id', 1)
                ->first();

            $otrosPagos = DB::table('socio_servicio_proceso')
                ->where('socio_id', $socio->id)
                ->where('proceso_id', $procesoId)
                ->where('servicio_id', 6)
                ->first();

            if ($cargoFijo) {
                $socio->cargoFijo = $cargoFijo->valor;
                $socio->costo += $socio->cargoFijo;
            }

            if ($otrosPagos) {
                $socio->otrosPagos = $otrosPagos->valor;
                $socio->costo += $socio->otrosPagos;
            }
            
        } else {
            $socio->consumo = null;
        }

        // Determine payment status based on whether the socio has paid the total amount
        $pagosTotales = DB::table('pagos')
            ->where('socio_id', $socio->id)
            ->where('proceso_id', $procesoId)
            ->sum('monto_total');
        $tipoPago = DB::table('pagos')
            ->where('socio_id', $socio->id)
            ->where('proceso_id', $procesoId)
            ->value('tipo_pago');
        //var_dump($tipoPago);
        $socio->estadoPago = ($socio->costo <= $pagosTotales) ? 'Pagado' : 'Pendiente';
        $socio->tipoPago = $tipoPago;

        unset($socio->lecturasDeAgua);  // Elimina la relación de lecturasDeAgua para aplanar la respuesta

        return $socio;
    });

    return response()->json($sociosTransformed);
}


public function getSociosWithPagos()
{
    // Fetch socios along with their payments
    $sociosWithPagos = Socio::with('pagos')->get();

    return response()->json($sociosWithPagos);
}

public function getMedidoresBySocio($id) {
    // Lógica para obtener los medidores asociados al socio con ID $id
    $medidores = Medidor::where('socio_id', $id)->get();
    return response()->json($medidores);
}


}
