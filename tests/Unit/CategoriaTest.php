<?php

use App\Models\Categoria;

it('cria uma categoria com sucesso', function () {
    $categoria = Categoria::factory()->create();

    expect($categoria->exists)->toBeTrue()
        ->and($categoria->nome)->not->toBeEmpty();
});
