@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    @include('erro')
    @include('sucesso')
    <h1>Bem vindo, {{ $usuario->nome }}!</h1>
</div>

@endsection