<?php

namespace App\Repositories;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;

class CategoriaRepository
{
    public function all($perPage = 10)
    {
        $paginacao = CategoriaResource::collection(Categoria::with('produtos')->paginate($perPage));

        return [
            'total' => $paginacao->total(),
            'por_pagina' => $paginacao->perPage(),
            'pagina' => $paginacao->currentPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'dados' => CategoriaResource::collection($paginacao->items()),
        ];
    }

    public function getCategoriasComProdutos($perPage = 10): array
    {
        $paginacao = Categoria::with('produtos')
            ->has('produtos')
            ->paginate($perPage);

        return [
            'total' => $paginacao->total(),
            'por_pagina' => $paginacao->perPage(),
            'pagina' => $paginacao->currentPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'dados' => CategoriaResource::collection($paginacao->items()),
        ];
    }

    public function find($id)
    {
        return new CategoriaResource(Categoria::with('produtos')->find($id));
    }

    public function create($data)
    {
        return new CategoriaResource(Categoria::create($data));
    }

    public function update($id, $data)
    {
        $categoria = Categoria::find($id);
        if ($categoria) {
            $categoria->update($data);
            return new CategoriaResource($categoria);
        }
        return null;
    }

    public function delete($id)
    {
        $categoria = Categoria::find($id);
        if ($categoria) {
            $categoria->delete();
            return true;
        }
        return false;
    }
}
