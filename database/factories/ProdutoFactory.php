<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'nome' => fake()->word(),
            'preco' => fake()->randomFloat(2, 1, 100),
            'categoria_id' => Categoria::factory(),
        ];
    }
}
