@extends('paginaAutenticada')

@section('allowed-content')

<div class="lista">
    <h1>Lista de itens</h1>
    <table>
        <thead>
            <tr>
                <td>Item</td>
                <td>Gênero</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            @foreach($itens as $item)
            <tr>
                <td>{{$item->nome}}</td>
                <td>{{$item->genero->nome}}</td>
                <td>
                    <div class="buttons">
                        <form action="{{route('form-edicao-item', $item->id)}}" method="get">
                            <button type="submit">🖊️</button>
                        </form>
                        <form action="{{route('form-remocao-item', $item->id)}}" method="get">
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