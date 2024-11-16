<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre', 
        'apellido', 
        'cargo', 
        'id_area', 
        'puesto', 
        'correo', 
        'telefono'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class,'id_area', 'id_area');
    }
}

