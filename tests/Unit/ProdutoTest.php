<?php

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('cria um produto com sucesso', function () {
    $categoria = Categoria::factory()->create();
    $produto = Produto::factory()->create(['categoria_id' => $categoria->id]);

    expect($produto->exists)->toBeTrue()
        ->and($produto->nome)->not->toBeEmpty()
        ->and($produto->preco)->toBeGreaterThan(0)
        ->and($produto->categoria_id)->toBe($categoria->id);
});
