<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $termo = trim($request->query('q', 'harry potter'));

        if ($termo === '') {
            $termo = 'harry potter';
        }

        $resposta = Http::timeout(15)->get(
            'https://openlibrary.org/search.json',
            [
                'q' => $termo,
                'fields' => 'key,title,author_name,first_publish_year,cover_i',
                'limit' => 10,
            ]
        );

        if ($resposta->failed()) {
            return view('livros.index', [
                'livros' => [],
                'termo' => $termo,
                'erro' => 'Não foi possível consultar a Open Library.',
            ]);
        }

        return view('livros.index', [
            'livros' => $resposta->json('docs', []),
            'termo' => $termo,
            'erro' => null,
        ]);
    }
}
