<?php

namespace App\Services;

use App\Models\Pedido;

class PedidoService
{
    public function calcularPrecoTotal($produtos)
    {
        return $produtos->sum(function ($produto) {
            return $produto['preco'] * $produto['quantidade'];
        });
    }

    public function processarProdutos(Pedido $pedido, $produtos)
    {
        $pedido->produtos()->detach();

        foreach ($produtos as $produto) {
            $pedido->produtos()->attach($produto['produto_id'], [
                'preco' => $produto['preco'],
                'quantidade' => $produto['quantidade'],
            ]);
        }
    }
}
