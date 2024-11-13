<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    //
    public function selectUsuario()
    {
        // Se realiza un select * from estudiante
        $usuarios = Usuarios::all();
        if ($usuarios->count() > 0) {
            // Si hay estudiantes registrados se retorna 
            // una respuesta en formato json
            return response()->json([
                'code' => 200,
                'data' => $usuarios
            ], 200);
        } else {
            // Si no hay usuarios registrados se retorna 
            // una respuesta en formato json
            return response()->json([
                'code' => 404,
                'data' => 'No hay registros'
            ], 404);
        }
    }

    public function storeUsuario(Request $request)
    {
        // Se validan los datos a recibir en el request/petición
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'contrasena' => 'required',
            'correo' => 'required',
            'rol' => 'required',
            'fecha' => 'required',
            
        ]);
        if ($validacion->fails()) {
            // Si hay error se retorna el mensaje de error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            // Si no hay error se inserta el usuario
            $usuarios = Usuarios::create($request->all());
            // Y se retorna un mensaje en formato json
            return response()->json([
                'code' => 200,
                'data' => 'Usuario insertado'
            ], 200);
        }
    }

    public function updateUsuario(Request $request, $id)
    {
        // Se validan los datos a recibir en el request/petición
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'contrasena' => 'required',
            'correo' => 'required',
            'rol' => 'required',
            'fecha' => 'requerid',
            
        ]);
        if ($validacion->fails()) {
            // Si hay error se retorna el mensaje de error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            // Si no hay error se buscar el usuario
            $usuarios = Usuarios::find($id);
            if ($usuarios) {
                // Si el usuario existe se actualiza 
                $usuarios->update([
                    'nombre' => $request->nombre,
                    'contrasena' => $request->contrasena,
                    'correo' => $request->correo,
                    'rol' => $request->rol,
                    'fecha' => $request->fecha,
                    
                ]);
                // Y se retorna una respuesta en formato json
                return response()->json([
                    'code' => 200,
                    'data' => 'Usuario actualizado'
                ], 200);
            } else {
                // Si no existe se retorna una respuesta en formato json
                return response()->json([
                    'code' => 404,
                    'data' => 'Usuario no encontrado'
                ], 404);
            }
        }
    }

    public function findUsuario($id)
    {
        // Se busca el usuario
    $usuarios = Usuarios::find($id);
        if ($usuarios) {
            // Si existe se retorna la información en formato json
            return response()->json([
                'code' => 200,
                'data' => $usuarios
            ], 200);
        } else {
            // Si no existe se retorna un mensaje en formato json
            return response()->json([
                'code' => 404,
                'data' => 'Usuario no encontrado'
            ], 404);
        }
    }

    public function deleteUsuario($id)
    {
        // Se busca el usuario
        $usuarios = Usuarios::find($id);
        if ($usuarios) {
            // Si el estudiante existe se elimina 
            $usuarios->delete();
            // Y se retorna una respuesta en formato json
            return response()->json([
                'code' => 200,
                'data' => 'Usuario eliminado'
            ], 200);
        } else {
            // Si no existe se retorna una respuesta en formato json
            return response()->json([
                'code' => 404,
                'data' => 'No hay registros'
            ], 404);
        }
    }

}
