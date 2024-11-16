<?php

namespace App\Http\Controllers;

use App\Models\HorasTrabajo;
use Illuminate\Http\Request;

class HorasTrabajoController extends Controller
{
    public function index()
    {
        return HorasTrabajo::with('empleado')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i:s',
        ]);

        return HorasTrabajo::create($validated);
    }

    public function show($id)
    {
        return HorasTrabajo::with('empleado')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $horaTrabajo = HorasTrabajo::findOrFail($id);
        $validated = $request->validate([
            'hora_salida' => 'nullable|date_format:H:i:s',
            'estado_validacion' => 'nullable|in:Pendiente,Aprobado,Rechazado',
            'comentario_validacion' => 'nullable|string',
        ]);

        $horaTrabajo->update($validated);
        return $horaTrabajo;
    }

    public function destroy($id)
    {
        $horaTrabajo = HorasTrabajo::findOrFail($id);
        $horaTrabajo->delete();
        return response()->noContent();
    }
}
