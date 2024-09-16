<?php

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('pode listar categorias', function () {
    Categoria::factory()->count(3)->create();

    $response = $this->getJson('/api/categorias');

    $response->assertStatus(200);
    $response->assertJsonCount(3, 'dados');
});

it('pode criar uma categoria via API', function () {
    $response = $this->postJson('/api/categorias', [
        'nome' => 'Categoria Teste',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('categorias', ['nome' => 'Categoria Teste']);
});
