<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        return Empleado::with('area')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'cargo' => 'required|string',
            'id_area' => 'required|exists:area,id_area', 
            'puesto' => 'required|string|max:50',
            'correo' => 'required|email|unique:empleados,correo', 
            'telefono' => 'required|string|max:20'
        ]);

        return Empleado::create($request->all());
    }

    public function show($id_empleado)
    {
        return Empleado::with('area')->findOrFail($id_empleado);
    }

    public function update(Request $request, $id_empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'cargo' => 'required|string',
            'id_area' => 'required|exists:area,id_area', 
            'puesto' => 'required|string|max:50',
            'correo' => 'required|email|unique:empleados,correo,' . $id_empleado . ',id_empleado', 
            'telefono' => 'required|string|max:20'
        ]);

        $empleado = Empleado::findOrFail($id_empleado);
        $empleado->update($request->all());
        
        return $empleado; 
    }

    public function destroy($id_empleado)
    {
        Empleado::destroy($id_empleado);
        
        return response()->noContent(); 
    }
}