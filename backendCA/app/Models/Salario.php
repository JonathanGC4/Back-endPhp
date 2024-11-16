<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    use HasFactory;

    protected $table = 'salarios';
    protected $primaryKey = 'id_salario';
    protected $fillable = [
        'id_empleado',
        'salario_base',
        'prestaciones',
        'activo_labores',
        'tipo_contrato',
        'numero_identificacion',
        'previo_horas_extra',
        'previo_nocturnidades'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
}
