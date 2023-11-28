<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
    use HasFactory;

    protected $table = 'medidores'; // Nombre de la tabla

    protected $fillable = ['id','socio_id','numero']; // Define los campos que se pueden llenar

}
