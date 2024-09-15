<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'estado' => $this->estado,
            'preco_total' => $this->preco_total,
            'produtos' => $this->produtos->map(function ($produto) {
                return [
                    'produto_id' => $produto->id,
                    'produto' => [
                        'nome' => $produto->nome,
                    ],
                    'quantidade' => $produto->pivot->quantidade,
                    'preco' => $produto->pivot->preco,
                ];
            }),
        ];
    }
}

