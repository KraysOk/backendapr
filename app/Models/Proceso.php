<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_proceso_id', 'fecha_emision', 'fecha_vencimiento', 'mes', 'ano'
    ];

    public function processtype() {
        return $this->belongsTo(Processtype::class, 'tipo_proceso_id', 'id');
    }

    public function serviciosPorSocio(Socio $socio)
    {
        return $this->belongsToMany(Servicio::class, 'socio_servicio_proceso')
                    ->wherePivot('socio_id', $socio->id)
                    ->withPivot('valor')
                    ->using(SocioServicioProceso::class);  // Esto es opcional y necesitas crear una clase personalizada para el modelo pivote
    }
    
}
