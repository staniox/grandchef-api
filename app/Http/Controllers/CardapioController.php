<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriaRepository;

class CardapioController extends Controller
{

    public function __construct(protected CategoriaRepository $categoriaRepo)
    {}

    public function index()
    {
        $categorias = $this->categoriaRepo->getCategoriasComProdutos();
        return response()->json($categorias);
    }
}
