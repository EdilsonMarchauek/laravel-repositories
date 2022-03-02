<!-- -->
<!-- Estendeu o layout-->
@extends('admin.layouts.app')

<!-- Título para a página -->
@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>

    <!-- action enviando para a o nome da rota -->
    <form action="{{ route('products.store') }}" method="post">
        <!-- cria o token -->
        @csrf
        <!-- <input type="text" name="_token" value="{{ csrf_token() }}"> -->
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <button type="submit">Enviar</button>
    </form>

@endsection