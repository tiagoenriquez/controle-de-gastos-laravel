@extends('index')

@section('content')

<div class="form">
    <h1>Cadastro de Usuário</h1>
    <form action="{{ route('cadastro-usuario') }}" method="post">
        @csrf
        <div class="campo-de-digitacao">
            <label for="">Nome</label>
            <input type="text" id="nome" name="nome" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Apelido</label>
            <input type="text" id="apelido" name="apelido" required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Senha</label>
            <input type="password" id="senha" name="senha" required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Confirme sua senha</label>
            <input type="password" id="confirmacao" name="confirmacao" required />
        </div>
        <div class="buttons">
            <button type="submit">Cadastrar-se</button>
        </div>        
    </form>
</div>

@endsection