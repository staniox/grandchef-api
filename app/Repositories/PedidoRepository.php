<?php

namespace App\Repositories;

use App\Http\Resources\PedidoResource;
use App\Models\Pedido;
use App\Services\PedidoService;

class PedidoRepository
{
    public function __construct(protected PedidoService $pedidoService)
    {}

    public function all($perPage = 10)
    {
        $paginacao = Pedido::with('produtos')->paginate($perPage);

        return [
            'total' => $paginacao->total(),
            'por_pagina' => $paginacao->perPage(),
            'pagina' => $paginacao->currentPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'dados' => $paginacao->map(function ($pedido) {
                return [
                    'id' => $pedido->id,
                    'preco_total' => $pedido->preco_total
                ];
            }),
        ];
    }

    public function find($id)
    {
        $pedido = Pedido::with('produtos')->find($id);

        if (!$pedido) {
            return null;
        }

        return new PedidoResource($pedido);
    }

    public function create($produtos)
    {
        $pedido = new Pedido();
        $pedido->estado = 'aberto';

        $precoTotal = $this->pedidoService->calcularPrecoTotal($produtos);
        $pedido->preco_total = $precoTotal;
        $pedido->save();

        $this->pedidoService->processarProdutos($pedido, $produtos);

        return new PedidoResource($pedido);
    }

    public function update($id, $estado = null)
    {
        $pedido = Pedido::with('produtos')->find($id);

        if (!$pedido) {
            return null;
        }

        if ($estado) {
            $pedido->estado = $estado;
        }

        $pedido->save();

        return new PedidoResource($pedido);
    }
}
