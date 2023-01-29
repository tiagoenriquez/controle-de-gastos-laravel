@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Tem certeza de que deseja excluir o item?</h1>
    <form action="{{route('remocao-item', $item->id)}}" method="post">
        @method('delete')
        @csrf
        <input type="hidden" name="id" id="id" value="{{$item->id}}">
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="{{$item->nome}}" readonly />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Gênero</label>
            <input type="text" name="genero" id="genero" value="{{$item->genero->nome}}" readonly />
        </div>
        <div class="buttons">
            <button type="submit">Sim</button>
        </form>
        <form action="{{route('lista-itens')}}" method="get">
            <button type="submit">Não</button>
        </div>
    </form>
</div>

@endsection