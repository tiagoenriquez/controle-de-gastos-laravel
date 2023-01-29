@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Cadastro de item</h1>
    <form action="{{route('cadastro-item')}}" method="post">
        @csrf
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Gênero</label>
            <select name="genero_id" id="genero_id">
                @foreach($generos as $genero)
                <option value="{{$genero->id}}">{{$genero->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="buttons">
            <button type="submit">Cadastrar item</button>
        </div>
    </form>
</div>

@endsection