@extends('paginaAutenticada')

@section('allowed-content')

<div class="lista">
    <h1>Lançamentos do Mês</h1>
    <form action="{{ route('lancamento') }}" method="get">
        <div class="campo-de-digitacao">
            <label for="">Tipo</label>
            <select name="tipo" id="tipo" value="{{$tipo}}">
                <option value="gasto">gasto</option>
                <option value="provento">provento</option>
            </select>
        </div>
        <div class="campo-de-digitacao">
            <label for="">Data</label>
            <input type="date" name="data" id="data" value={{$data}} required />
        </div>
        <div class="buttons">
            <button type="submit">Listar Lançamentos</button>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <td>Item</td>
                <td>Valor</td>
                <td>Data</td>
                <td>Gênero</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            @foreach($lancamentos as $lancamento)
            <tr>
                <td>{{$lancamento->item->nome}}</td>
                <td>R$ {{number_format(abs($lancamento->valor), 2, ',', '')}}</td>
                <td>{{date('d/m/Y', strtotime($lancamento->data))}}</td>
                <td>{{$lancamento->item->genero->nome}}</td>
                <td>
                    <div class="buttons">
                        <form action="{{route('form-edicao-lancamento', $lancamento->id)}}" method="get">
                            <button type="submit">🖊️</button>
                        </form>
                        <form action="{{route('form-remocao-lancamento', $lancamento->id)}}" method="get">
                            <button type="submit">X</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection