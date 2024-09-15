<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Repositories\ProdutoRepository;

class ProdutoController extends Controller
{
    public function __construct( protected ProdutoRepository $produtoRepo)
    {}

    public function index()
    {
        $produtos = $this->produtoRepo->all(10);

        return response()->json($produtos, 200);
    }

    public function store(StoreProdutoRequest $request)
    {
        $produto = $this->produtoRepo->create($request->validated());
        return response()->json(new ProdutoResource($produto), 201);
    }
}
