<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'nombre'];
    
    public function socios()
    {
        return $this->hasMany(Socio::class);
    }
}
