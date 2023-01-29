@extends('paginaAutenticada')

@section('allowed-content')

<div class="lista">
    <h1>Lista de gêneros</h1>
    <table>
        <thead>
            <tr>
                <td>Gênero</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            @foreach($generos as $genero)
            <tr>
                <td>{{$genero->nome}}</td>
                <td>
                    <div class="buttons">
                        <form action="{{route('form-edicao-genero', $genero->id)}}" method="get">
                            <button type="submit">🖊️</button>
                        </form>
                        <form action="{{route('form-remocao-genero', $genero->id)}}" method="get">
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