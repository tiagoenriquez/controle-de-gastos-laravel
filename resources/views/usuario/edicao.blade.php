@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Atualização de dados de usuário</h1>
    <form action="{{ route('edicao-usuario', $usuario->id) }}" method="post">
        @method('put')
        @csrf
        <input type="hidden" name="usuario" id="usuario" value="{{$usuario->id}}" />
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="{{$usuario->nome}}" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Apelido</label>
            <input type="text" name="apelido" id="apelido" value="{{$usuario->apelido}}" required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Senha</label>
            <input type="password" name="senha" id="senha" required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Confirme a sua senha</label>
            <input type="password" name="confirmacao" id="confirmacao" required />
        </div>
        <div class="buttons">
            <button type="submit">Atualizar cadastro</button>
        </div>
    </form>
</div>

@endsection