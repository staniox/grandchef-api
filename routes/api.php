<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('produtos', ProdutoController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::get('cardapio', [CardapioController::class, 'index']);
