<!-- Estendeu o layout-->
@extends('admin.layouts.app')

<!-- Título para a página -->
@section('title', 'Editar Produto')

@section('content')
    <!-- imprime o id do produto -->
    <h1>Editar Produto {{ $id }}</h1>

    <!-- action enviando para a o nome da rota com o id-->
    <form action="{{ route('products.update', $id) }}" method="post">
        <!-- Update necessita ser PUT -->
        @method('PUT')
        <!--  <input type="hidden" name="_method" value="PUT"> -->
        <!-- cria o token -->
        @csrf
        <!-- <input type="text" name="_token" value="{{ csrf_token() }}"> -->
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <button type="submit">Enviar</button>
    </form>

@endsection