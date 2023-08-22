<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocioController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ProcessTypeController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\LecturaAguaController;
use App\Http\Controllers\TramoController;
use App\Http\Controllers\PagoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/socio', [SocioController::class, 'index']);
Route::post('/socio', [SocioController::class, 'store']);
Route::delete('/socio/{id}', [SocioController::class, 'destroy']);
Route::get('/socio/{proceso}', [SocioController::class, 'getSocios']);

Route::get('/sectores', [SectorController::class, 'index']);
Route::post('/sectores', [SectorController::class, 'store']);

Route::apiResource('servicios', ServicioController::class);

Route::post('/tipos-proceso', [ProcessTypeController::class, 'store']);
Route::get('/tipos-proceso', [ProcessTypeController::class, 'index']);

Route::apiResource('procesos', ProcesoController::class);
Route::get('/proceso/{proceso}/socio/{socio}/servicios', [ServicioController::class, 'getServiciosByProcesoAndSocio']);

Route::apiResource('lectura-agua', LecturaAguaController::class);
Route::get('/lectura-agua/socio/{socio_id}/proceso/{proceso_id}', [LecturaAguaController::class, 'getLecturaBySocioAndProceso']);

Route::apiResource('tramos', TramoController::class);

Route::post('/socio-servicio-proceso', [ServicioController::class, 'storeSocioServicioProceso']);
Route::get('/socio-servicio-proceso/{proceso}/{socio}', [ServicioController::class, 'getServiciosByProcesoAndSocio']);

Route::post('/pagos', [PagoController::class, 'store']);
Route::get('/socios-with-pagos', [SocioController::class, 'getSociosWithPagos']);
