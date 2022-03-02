<!-- Usando o template -->
@extends('admin.layouts.app')

<!-- layout: yield title dinâmico -->
@section('title', 'Gestão de Produtos')

<!-- layout: content da página -->
@section('content')
    <h1>Exibindo os produtos</h1>

    @component('admin.components.card')
    <!-- Card: Usando slot-->
        @slot('title')
            <h1>Título Card</h1>
        @endslot
        Um card de exemplo
    @endcomponent 

    <!-- Includes: passando valor -->    
    @include('admin.includes.alerts', ['content' => 'Alerta de preços de produtos'])

     <!-- Foreach - Diretivas de repetição  -->
    @if (isset($products))
        @foreach ($products as $product)
              <!-- Loop pegando o último elemento e atribui o CSS -->
            <p class="@if ($loop->last) last @endif">{{ $product }}</p>
        @endforeach
    @endif

    <hr>
    <!-- Forelse - Diretiva de repetição -->
    @forelse ($products as $product)
            <!-- loop pegando o primeiro elemento e atribui o CSS -->
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

    <!-- Unless - só entra se for falso -->
    @unless ($teste = '123')
        dsfdsfs
    @else
        dsfdsfs
    @endunless

    <!-- Isset - verifica se a variável existe -->
    @isset($teste2)
        <p>{{ $teste2 }}</p>
    @endisset

    <!-- Empty - verifica se a variável está vazia -->
    @empty($teste3)
        <p>Vazio...</p>
    @endempty

    <!-- Auth - só entra se estiver autenticado -->
    @auth
        <p>Autenticação</p>
    @else 
       <p>Não autenticado</p>
    @endauth

    <!-- Guest - só entra se não estiver autenticado -->
    @guest
        <p>Não autenticado</p>
    @endguest

    <!-- Switch -->
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

<!-- layouts - usando o stack para partes específicas do projeto -->
@push('styles')
    <style>
        .last {background: #CCC;}
    </style>
@endpush

@push('scripts')
    <script>
        document.body.style.background = '#efefef'
    </script>
@endpush
