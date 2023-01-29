@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Tem certeza de que deseja excluir todos os lançamentos?</h1>
    <form action="{{ route('remocao-todos-lancamentos') }}" method="post">
        @method('delete')
        @csrf
        <div class="buttons">
            <button type="submit">Sim</button>
        </form>
        <form action="{{route('gastos-do-mes-atual')}}" method="get">
            <button type="submit">Não</button>
        </div>
    </form>
</div>

@endsection