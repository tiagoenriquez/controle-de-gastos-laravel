@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Tem certeza de que deseja excluir o lançamento?</h1>
    <form action="{{route('remocao-lancamento', $lancamento->id)}}" method="post">
        @method('delete')
        @csrf
        <input type="hidden" name="id" id="id" value="{{$lancamento->id}}">
        <div class="campo-de-digitacao">
            <label for="">Item</label>
            <input type="text" name="nome" id="nome" value="{{$lancamento->item->nome}}" readonly />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Gênero</label>
            <input type="text" name="genero" id="genero" value="{{$lancamento->item->genero->nome}}" readonly />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Data</label>
            <input type="date" name="data" id="data" value="{{$lancamento->data}}" readonly />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Valor</label>
            <input type="text" name="valor" id="valor" value="R$ {{number_format(abs($lancamento->valor), 2, ',', '')}}" readonly />
        </div>
        <div class="buttons">
            <button type="submit">Sim</button>
        </form>
        <form action="{{route('gastos-do-mes-atual')}}" method="get">
            <button type="submit">Não</button>
        </div>
    </form>
</div>

@endsection