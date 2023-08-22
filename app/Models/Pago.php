<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'proceso_id', 'tipo_pago', 'monto_total'];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }
}
