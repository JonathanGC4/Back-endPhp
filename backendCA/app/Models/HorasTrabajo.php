<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorasTrabajo extends Model
{
    use HasFactory;

    protected $table = 'horas_trabajo';
    protected $primaryKey = 'id_hora_trabajo';
    protected $fillable = [
        'id_empleado',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'horas_laboradas',
        'estado_validacion',
        'comentario_validacion'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
}

