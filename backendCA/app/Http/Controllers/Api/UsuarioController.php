<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::with('empleado')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario',
            'contrasena' => 'required|string'
        ]);

        $usuario = new Usuario();
        $usuario->id_empleado = $request->id_empleado;
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->contrasena = Hash::make($request->contrasena);  // Encriptar la contraseña
        $usuario->save();

        return $usuario;
    }

    public function show($id)
    {
        return Usuario::with('empleado')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'nombre_usuario' => $request->nombre_usuario,
            'contrasena' => Hash::make($request->contrasena)
        ]);
        return $usuario;
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->noContent();
    }
}
