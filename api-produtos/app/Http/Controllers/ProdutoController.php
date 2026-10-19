<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return response()->json(Produto::all(), 200);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        $produto = Produto::create($dados);

        return response()->json($produto, 201);
    }

    public function show(Produto $produto)
    {
        return response()->json($produto, 200);
    }

    public function update(Request $request, Produto $produto)
    {
        $dados = $request->validate([
            'nome' => 'sometimes|required|string|max:150',
            'descricao' => 'sometimes|nullable|string',
            'preco' => 'sometimes|required|numeric|min:0',
            'estoque' => 'sometimes|required|integer|min:0',
        ]);

        $produto->update($dados);

        return response()->json($produto, 200);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return response()->json([
            'mensagem' => 'Produto excluído com sucesso.'
        ], 200);
    }
}
