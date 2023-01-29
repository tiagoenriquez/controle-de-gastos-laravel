@extends('index')

@section('content')

<div class="form">
    <h1>Página não encontrada</h1>
    <form action="{{ route('form-login') }}" method="get">
        <div class="buttons">
            <button type="submit">Logar</button>
        </div>
    </form>
</div>

@endsection