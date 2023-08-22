<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'email', 'telefono', 'sector_id'];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'socio_servicio_proceso')
                    ->withPivot('proceso_id', 'valor')
                    ->using(SocioServicioProceso::class); // Esto es opcional y necesitas crear una clase personalizada para el modelo pivote
    }

    public function lecturasDeAgua() {
        return $this->hasMany(LecturaAgua::class, 'socio_id');
    }
}
