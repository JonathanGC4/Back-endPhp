<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //Nombre de la tabla
    protected $table = 'usuarios';

    //campos
    protected $fillable = [
        'nombre',
        'contrasena',
        'correo',
        'rol',
        'fecha',
    ];
}
