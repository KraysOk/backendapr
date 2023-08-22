<?php

namespace App\Http\Controllers;

use App\Models\Pago;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function store(Request $request)
    {
        // Aquí procesa la solicitud y guarda el pago en la base de datos
        // Puedes acceder a los datos enviados desde el frontend usando $request->input('nombre_del_campo')

        // Ejemplo:
        $nuevoPago = new Pago();
        $nuevoPago->socio_id = $request->input('socio_id');
        $nuevoPago->proceso_id = $request->input('proceso_id');
        $nuevoPago->tipo_pago = $request->input('tipo_pago');
        $nuevoPago->monto_total = $request->input('monto_total');
        $nuevoPago->save();

        return response()->json(['success' => true, 'pago' => $nuevoPago]);
    }
}
