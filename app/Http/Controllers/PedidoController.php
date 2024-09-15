<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePedidoRequest;
use App\Repositories\PedidoRepository;
use App\Http\Requests\StorePedidoRequest;

class PedidoController extends Controller
{
    public function __construct(protected PedidoRepository $pedidoRepo)
    {}

    public function index()
    {
        $pedidos = $this->pedidoRepo->all(10);

        return response()->json($pedidos, 200);
    }

    public function show($id)
    {
        $pedido = $this->pedidoRepo->find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }

        return response()->json($pedido);
    }

    public function store(StorePedidoRequest $request)
    {
        $pedido = $this->pedidoRepo->create(collect($request->produtos));
        return response()->json($pedido, 201);
    }

    public function update(UpdatePedidoRequest $request, $id)
    {
        $pedido = $this->pedidoRepo->update($id, $request->input('estado'));

        if (!$pedido) {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }

        return response()->json($pedido);
    }

}
