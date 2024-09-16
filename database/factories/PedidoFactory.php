<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Produto;
use App\Enums\EstadoPedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        return [
            'estado' => EstadoPedido::ABERTO->value,
            'preco_total' => fake()->randomFloat(2, 10, 500),
        ];
    }

    public function withProdutos($quantidade = 1)
    {
        return $this->afterCreating(function (Pedido $pedido) use ($quantidade) {
            Produto::factory()->count($quantidade)->create()->each(function ($produto) use ($pedido) {
                $pedido->produtos()->attach($produto->id, [
                    'preco' => $produto->preco,
                    'quantidade' => rand(1, 5),
                ]);
            });
        });
    }
}
