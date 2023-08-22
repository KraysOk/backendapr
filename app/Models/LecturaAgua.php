<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturaAgua extends Model
{
    use HasFactory;

    protected $fillable = ['proceso_id', 'socio_id', 'consumption_value'];

    public function proceso() {
        return $this->belongsTo(Proceso::class);
    }
    
    public function socio() {
        return $this->belongsTo(Socio::class);
    }
}
