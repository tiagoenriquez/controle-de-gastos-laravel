@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Edição de item</h1>
    <form action="{{route('edicao-item', $item->id)}}" method="post">
        @method('put')
        @csrf
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="{{$item->nome}}" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Gênero</label>
            <select name="genero_id" id="genero_id">
                <option value="{{$item->genero->id}}">{{$item->genero->nome}}</option>
                @foreach($generos as $genero)
                <option value="{{$genero->id}}">{{$genero->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="buttons">
            <button type="submit">Atualizar item</button>
        </div>
    </form>
</div>

@endsection