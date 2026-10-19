
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesquisa de Livros</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
            background: #f5f5f5;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        input {
            flex: 1;
            padding: 12px;
        }

        button {
            padding: 12px 20px;
            cursor: pointer;
        }

        .livro {
            background: white;
            padding: 18px;
            margin-bottom: 15px;
            border-radius: 8px;
            display: flex;
            gap: 20px;
        }

        .capa {
            width: 100px;
            height: 150px;
            object-fit: contain;
        }

        .sem-capa {
            width: 100px;
            min-width: 100px;
            height: 120px;
            background: #e5e5e5;
            display: grid;
            place-items: center;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Pesquisa de Livros</h1>

    <p>
        Consulte títulos e autores utilizando a Open Library API.
    </p>

    <form method="GET" action="{{ route('livros.index') }}">
        <input
            type="text"
            name="q"
            value="{{ $termo }}"
            placeholder="Digite o nome de um livro ou autor"
            required
        >

        <button type="submit">Pesquisar</button>
    </form>

    @if ($erro)
        <p>{{ $erro }}</p>
    @elseif (count($livros) === 0)
        <p>Nenhum livro encontrado.</p>
    @else
        <p>Resultados para: <strong>{{ $termo }}</strong></p>

        @foreach ($livros as $livro)
            <article class="livro">

                <div>
                    @if (!empty($livro['cover_i']))
                        <img
                            class="capa"
                            src="https://covers.openlibrary.org/b/id/{{ $livro['cover_i'] }}-M.jpg"
                            alt="Capa do livro {{ $livro['title'] ?? 'Livro' }}"
                        >
                    @else
                        <div class="sem-capa">
                            Capa indisponível
                        </div>
                    @endif
                </div>

                <div>
                    <h2>
                        {{ $livro['title'] ?? 'Título não informado' }}
                    </h2>

                    <p>
                        <strong>Autor(es):</strong>
                        {{ implode(', ', $livro['author_name'] ?? ['Não informado']) }}
                    </p>

                    <p>
                        <strong>Primeira publicação:</strong>
                        {{ $livro['first_publish_year'] ?? 'Não informado' }}
                    </p>

                    <p>
                        <strong>ID da obra:</strong>
                        {{ $livro['key'] ?? 'Não informado' }}
                    </p>
                </div>

            </article>
        @endforeach
    @endif

</body>
</html>
