<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use Illuminate\Http\Request;

class SalarioController extends Controller
{
    public function index()
    {
        return Salario::with('empleado')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'salario_base' => 'required|numeric',
            'prestaciones' => 'required|numeric',
            'activo_labores' => 'required|boolean',
            'tipo_contrato' => 'required|in:Freelance,Planilla',
        ]);

        return Salario::create($validated);
    }

    public function show($id)
    {
        return Salario::with('empleado')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $salario = Salario::findOrFail($id);
        $validated = $request->validate([
            'salario_base' => 'nullable|numeric',
            'prestaciones' => 'nullable|numeric',
            'activo_labores' => 'nullable|boolean',
            'tipo_contrato' => 'nullable|in:Freelance,Planilla',
        ]);

        $salario->update($validated);
        return $salario;
    }

    public function destroy($id)
    {
        $salario = Salario::findOrFail($id);
        $salario->delete();
        return response()->noContent();
    }
}
