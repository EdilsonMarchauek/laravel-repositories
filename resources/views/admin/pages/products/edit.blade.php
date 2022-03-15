<!-- Estendeu o layout-->
@extends('admin.layouts.app')

<!-- Título para a página -->
@section('title', "Editar Produto {$product->name}")

@section('content')
    <!-- imprime o id do produto -->
    <h1>Editar Produto {{ $product->name }}</h1>

    <!-- action enviando para a o nome da rota com o id-->
    <form action="{{ route('products.update', $product->id) }}" method="post">
        <!-- Method: Update necessita ser PUT -->
        @method('PUT')
        <!--  <input type="hidden" name="_method" value="PUT"> -->
        <!-- cria o token -->
        @include('admin.pages.products._partials.form')
    </form>

@endsection