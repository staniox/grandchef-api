<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use App\Repositories\CategoriaRepository;
use Exception;

class CategoriaController extends Controller
{
    public function __construct(protected CategoriaRepository $categoriaRepo)
    {}

    public function index()
    {
        $categorias = $this->categoriaRepo->all();

        return response()->json($categorias, 200);
    }

    public function store(StoreCategoriaRequest $request)
    {
        $categoria = $this->categoriaRepo->create($request->validated());

        return response()->json($categoria, 201);
    }

    public function show($id)
    {
        $categoria = $this->categoriaRepo->find($id);

        if (!$categoria) {
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }

        return response()->json($categoria);
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria = $this->categoriaRepo->update($categoria->id, $request->validated());

        return response()->json($categoria);
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->categoriaRepo->delete($id);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        if (!$deleted) {
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }

        return response()->json(null, 204);
    }
}
