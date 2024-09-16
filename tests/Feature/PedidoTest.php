<?php

use App\Models\Pedido;
use App\Enums\EstadoPedido;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePedidoRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('pode criar um pedido via API', function () {
    $produtos = Produto::factory()->count(2)->create();

    $response = $this->postJson('/api/pedidos', [
        'produtos' => [
            ['produto_id' => $produtos[0]->id, 'preco' => $produtos[0]->preco, 'quantidade' => 2],
            ['produto_id' => $produtos[1]->id, 'preco' => $produtos[1]->preco, 'quantidade' => 1],
        ]
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('pedidos', ['id' => $response->json('id')]);
});

it('valida que o estado não pode ser igual ao atual', function () {
    $pedido = Pedido::factory()->create([
        'estado' => EstadoPedido::ABERTO,
    ]);

    $response = $this->json('PUT', "/api/pedidos/{$pedido->id}", [
        'estado' => EstadoPedido::ABERTO->value,
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('estado');
});

it('valida que o estado pode ser alterado corretamente via API', function () {
    $pedido = Pedido::factory()->withProdutos(3)->create(['estado' => EstadoPedido::ABERTO]);

    $response = $this->json('PUT', "/api/pedidos/{$pedido->id}", [
        'estado' => EstadoPedido::APROVADO->value,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('pedidos', [
        'id' => $pedido->id,
        'estado' => EstadoPedido::APROVADO->value,
    ]);
});
