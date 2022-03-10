<!-- -->
<!-- Estendeu o layout-->
@extends('admin.layouts.app')

<!-- Título para a página -->
@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>

    {{-- Validação do form :
        criar a classe: 
        php artisan make:request StoreUpdateProductRequest 
        app/Controllers/Requests/StoreUpdateProductRequest.php
    --}}
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
        </ul>
    @endif

    <!-- action enviando para a o nome da rota -->
    {{-- Upload: é obrigatório informar o enctype --}}
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        <!-- cria o token -->
        @csrf
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        {{-- value helper old para recuperar o valor informado --}}
        <input type="text" name="name" placeholder="Nome:" value="{{ old('name')}}">
        <input type="text" name="description" placeholder="Descrição:"  value="{{ old('description')}}">
        <input type="file" name="photo">
        <button type="submit">Enviar</button>
    </form>

@endsection