@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Edição de lançamento</h1>
    <form action="{{ route('edicao-lancamento', $lancamento->id) }}" method="post">
        @method('put')
        @csrf
        <input type="hidden" name="lancamento_id" id="lancamento_id" value="{{$lancamento->id}}">
        <div class="campo-de-digitacao">
            <label for="">Data</label>
            <input type="date" name="data" id="data" value="{{$lancamento->data}}" autofocus required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Valor</label>
            <input type="text" name="valor" id="valor" onkeyup="validarValor()" value="{{number_format(abs($lancamento->valor), 2, ',', '')}}" required />
        </div>
        <div class="campo-de-digitacao">
            <label for="">Item</label>
            <select name="item_id" id="item_id">
                <option value="{{$lancamento->item_id}}">{{$lancamento->item->nome}}</option>
                @foreach($itens as $item)
                <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="campo-de-digitacao">
            <label for="">Tipo</label>
            <select name="tipo" id="tipo">
                <option value="{{$tipo}}">{{$tipo}}</option>
                <option value="gasto">gasto</option>
                <option value="provento">provento</option>
            </select>
        </div>
        <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario->id}}" />
        <div class="buttons">
            <button type="submit">Atualizar lançamento</button>
        </div>
    </form>
</div>

@endsection