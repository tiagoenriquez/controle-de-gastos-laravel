@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Cadastro de lançamento</h1>
    <form action="{{ route('cadastro-lancamento') }}" method="post">
        @csrf
        <div class="campo-de-digitacao">
            <label for="">Data</label>
            <input type="date" name="data" id="data" value="{{date('Y-m-d')}}" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Valor</label>
            <input type="text" name="valor" id="valor" onkeyup="validarValor()" required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Item</label>
            <select name="item_id" id="item_id">
                @foreach($itens as $item)
                <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="campo-de-digitacao">
            <label for="">Tipo</label>
            <select name="tipo" id="tipo">
                <option value="gasto">gasto</option>
                <option value="provento">provento</option>
            </select>
        </div>
        <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario->id}}" />
        <div class="buttons">
            <button type="submit">Cadastrar lançamento</button>
        </div>
    </form>
</div>

@endsection