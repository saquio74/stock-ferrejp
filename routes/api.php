<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Product routes
Route::get('productos',             [ProductosController::class,'index']);
Route::post('productos',            [ProductosController::class,'store']);
Route::delete('productos/{id}',     [ProductosController::class,'destroy']);
Route::put('productos',             [ProductosController::class,'update']);
//sell routes
Route::get('ventas',                [VentasController::class,'index']);
Route::post('ventas',               [VentasController::class,'store']);
Route::delete('ventas/{id}',        [VentasController::class,'destroy']);