@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Cadastro de gênero</h1>
    <form action="{{ route('cadastro-genero') }}" method="post">
        @csrf
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" autofocus required />
        </div>
        <div class="buttons">
            <button type="submit">Cadastrar gênero</button>
        </div>
    </form>
</div>

@endsection