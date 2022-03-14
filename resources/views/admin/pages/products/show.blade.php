<!-- Usando o template -->
@extends('admin.layouts.app')

<!-- layout: yield title dinâmico -->
@section('title', "Detalhes do produto {$product->name}")

<!-- layout: content da página -->
@section('content')

<h1>Produto {{ $product->name }} <a href="{{ route('products.index') }}"><<</a></h1>

<ul>
    <li><strong>Nome: </strong>{{ $product->name }}</li>
    <li><strong>Preço: </strong>{{ $product->price }}</li>
    <li><strong>Descrição: </strong>{{ $product->description }}</li>
</ul>


@endsection