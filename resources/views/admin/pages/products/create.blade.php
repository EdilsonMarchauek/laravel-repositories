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
    

    <!-- action enviando para a o nome da rota -->
    {{-- Upload: é obrigatório informar o enctype --}}
    <form action="{{ route('products.store') }}" method="post" class="form" enctype="multipart/form-data">
        @include('admin.pages.products._partials.form')
    </form>

@endsection