@extends('index')

@section('content')

<div class="form">
    <h1>Login</h1>
    @include('erro')
    @include('sucesso')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="campo-de-digitacao">
            <label for="">Apelido</label>
            <input type="text" id="apelido" name="apelido" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Senha</label>
            <input type="password" id="senha" name="senha" required />
        </div>
        <div class="buttons">
            <button type="submit">Logar</button>
            </form>
            <form action="{{ route('form-cadastro-usuario') }}" method="get">
            <button>Cadastrar-se</button>
        </div>
    </div>
</form>

@endsection