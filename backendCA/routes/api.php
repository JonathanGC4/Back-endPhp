<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\SalarioController;
use App\Http\Controllers\Api\HorasTrabajoController;


Route::apiResource('areas', AreaController::class);
Route::apiResource('empleados', EmpleadoController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('salarios', SalarioController::class);
Route::apiResource('horas-trabajo', HorasTrabajoController::class);