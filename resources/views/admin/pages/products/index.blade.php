<!-- Usando o template -->
@extends('admin.layouts.app')

<!-- layout: yield title dinâmico -->
@section('title', 'Gestão de Produtos')

<!-- layout: content da página -->
@section('content')
    <h1>Exibindo os produtos</h1>

    <!-- link para cadastrar produto -->
    <a href="{{ route('products.create') }}" class="btn btn-primary">Cadastrar</a>
    <hr>

    <!--Listando os produtos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th width="100">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    {{-- Detalhes exibe o produto pelo id --}}
                    <a href="{{ route('products.show', $product->id) }}">Detalhes</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- cria os links de paginação --}}
    {!! $products->links() !!} 

@endsection