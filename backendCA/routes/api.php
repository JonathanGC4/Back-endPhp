<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/usuario/select', [UsuariosController::class, 'selectUsuario']);
Route::post('/usuario/store', [UsuariosController::class, 'storeUsuario']);
Route::put('/usuario/update/{id}', [UsuariosController::class, 'updateUsuario']);
Route::get('/usuario/find/{id}', [UsuariosController::class, 'findUsuario']);
Route::delete('/usuario/delete/{id}', [UsariosController::class, 'deleteUsuario']);