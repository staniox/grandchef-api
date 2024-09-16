<?php

use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Pedido;
use App\Models\Produto;
use App\Enums\EstadoPedido;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;

uses(RefreshDatabase::class);

it('cria um pedido com sucesso', function () {
    $pedido = Pedido::factory()->create();

    expect($pedido->exists)->toBeTrue()
        ->and($pedido->estado)->toBe(EstadoPedido::ABERTO->value);
});

it('associa produtos ao pedido com sucesso', function () {
    $produtos = Produto::factory()->count(3)->create();
    $pedido = Pedido::factory()->create();

    $pedido->produtos()->attach($produtos->pluck('id'), [
        'preco' => 10.00,
        'quantidade' => 2
    ]);

    expect($pedido->produtos()->count())->toBe(3);
});

it('valida que o estado é obrigatório', function () {
    $request = new UpdatePedidoRequest();

    $validator = Validator::make([], $request->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->first('estado'))->toBe('The estado field is required.');
});

it('valida que o estado é um enum válido', function () {
    $request = new UpdatePedidoRequest();

    $validator = Validator::make(['estado' => 'invalido'], $request->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->first('estado'))->toBe('The selected estado is invalid.');
});
