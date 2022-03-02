<!-- Usando o template -->
@extends('admin.layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')
    <h1>Exibindo os produtos</h1>

    <!-- Usando componentes -->
    @component('admin.components.card')
        @slot('title')
            <h1>Título Card</h1>
        @endslot
        Um card de exemplo
    @endcomponent 

    <!-- Includes passando valor -->    
    @include('admin.includes.alerts', ['content' => 'Alerta de preços de produtos'])

     <!-- Diretivas de repetição -->
    @if (isset($products))
        @foreach ($products as $product)
            <p class="@if ($loop->last) last @endif">{{ $product }}</p>
        @endforeach
    @endif

    <hr>
    <!-- forelse repeticao -->
    @forelse ($products as $product)
            <p class="@if ($loop->first) last @endif">{{ $product }}</p>
    @empty
        <p>Não existem produtos cadastrados</p>
    @endforelse
    
    <hr>
    <!-- Diretivas de verificação -->
    <!-- if else -->
    @if ($teste === '123')
        É igual
    @elseif($teste == 123)
        É igual a 123    
    @else 
        É diferente    
    @endif

    <!-- Unless Só entra se for falso -->
    @unless ($teste = '123')
        dsfdsfs
    @else
        dsfdsfs
    @endunless

    <!-- Isset Verifica se a variável existe -->
    @isset($teste2)
        <p>{{ $teste2 }}</p>
    @endisset

    <!-- empty Verifica se a variável está vazia -->
    @empty($teste3)
        <p>Vazio...</p>
    @endempty

    <!-- auth só entra se estiver autenticado -->
    @auth
        <p>Autenticação</p>
    @else 
       <p>Não autenticado</p>
    @endauth

    <!-- guest só entra se não estiver autenticado -->
    @guest
        <p>Não autenticado</p>
    @endguest

    <!-- switch -->
    @switch($teste)
        @case(1)
            Igual a 1
            @break
        @case(2)
            Igual a 2
            @break
        @case(3)
            Igual a 3
            @break   
        @case(123)
            Igual a 123
            @break      
        @default
            Default
    @endswitch

@endsection

<style>
    .last {background: #CCC;}
</style>
