<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocioServicioProceso extends Model
{
    use HasFactory;

    public $timestamps = false;


    // Tabla asociada al modelo
    protected $table = 'socio_servicio_proceso';

    // Atributos asignables en masa (para asignación en masa)
    protected $fillable = [
        'socio_id',
        'servicio_id',
        'proceso_id',
        'valor'
    ];

    // Relaciones con otros modelos

    // Socio
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    // Servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    // Proceso
    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }
}