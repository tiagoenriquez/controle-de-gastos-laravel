@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Edição de gênero</h1>
    <form action="{{route('edicao-genero', $genero->id)}}" method="post">
        @method('put')
        @csrf
        <input type="hidden" name="id" id="id" value="{{$genero->id}}">
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="{{$genero->nome}}" autofocus required />
        </div>
        <div class="buttons">
            <button type="submit">Atualizar gênero</button>
        </div>
    </form>
</div>

@endsection