<?php

namespace App\Repositories;

use App\Http\Resources\ProdutoResource;
use App\Models\Produto;

class ProdutoRepository
{

    public function all($perPage = 10): array
    {
        $paginacao = Produto::with('categoria')->paginate($perPage);

        return [
            'total' => $paginacao->total(),
            'por_pagina' => $paginacao->perPage(),
            'pagina' => $paginacao->currentPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'dados' => ProdutoResource::collection($paginacao->items()),
        ];
    }
    public function create($data)
    {
        return Produto::create($data);
    }
}
