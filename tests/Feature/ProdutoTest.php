<?php

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('pode listar produtos', function () {
    Categoria::factory()->create();
    Produto::factory()->count(3)->create();

    $response = $this->getJson('/api/produtos');

    $response->assertStatus(200);
    $response->assertJsonCount(3, 'dados');
});

it('pode criar um produto via API', function () {
    $categoria = Categoria::factory()->create();

    $response = $this->postJson('/api/produtos', [
        'nome' => 'Produto Teste',
        'preco' => 9.99,
        'categoria_id' => $categoria->id,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('produtos', ['nome' => 'Produto Teste']);
});
