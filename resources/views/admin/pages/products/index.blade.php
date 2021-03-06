<!-- Usando o template -->
@extends('admin.layouts.app')

<!-- layout: yield title dinâmico -->
@section('title', 'Gestão de Jogos')

<!-- layout: content da página -->
@section('content')
    <h1>Exibindo os jogos</h1>

    <!-- link para cadastrar produto -->
    <a href="{{ route('products.create') }}" class="btn btn-primary">Cadastrar</a>
    <hr>

    <form action="{{ route('products.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? ''}}">
        <button type="submit" class="btn btn-info">Pesquisar</button>
    </form> 

    <!--Listando os produtos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="100">Imagem</th>
                <th>Nome</th>
                <th>Console</th>
                <th width="100">Ações</th>
            </tr>
        </thead>
        <tbody>
                   @foreach ($products as $product)
            <tr>
                <td>
                    @if ($product->image)
                        <img src="{{ URL("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    {{-- Exibe o produto pelo id --}}
                    <a href="{{ route('products.edit', $product->id) }}">Editar</a>
                    <a href="{{ route('products.show', $product->id) }}">Detalhes</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

       
    @if (isset($filters))
        {!! $products->appends($filters)->links() !!} 
    @else
        {!! $products->links() !!} 
        
    @endif

@endsection