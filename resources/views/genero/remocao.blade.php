@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Tem certeza de que deseja excluir o gênero?</h1>
    <form action="{{route('remocao-genero', $genero->id)}}" method="post">
        @method('delete')
        @csrf
        <input type="hidden" name="id" id="id" value="{{$genero->id}}">
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="{{$genero->nome}}" readonly />
        </div>
        <div class="buttons">
            <button type="submit">Sim</button>
        </form>
        <form action="{{route('lista-generos')}}" method="get">
            <button type="submit">Não</button>
        </div>
    </form>
</div>

@endsection