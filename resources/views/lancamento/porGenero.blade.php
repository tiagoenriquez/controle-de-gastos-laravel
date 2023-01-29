@extends('paginaAutenticada')

@section('allowed-content')

<div class="lista">
    <h1>Lançamentos por gêneros</h1>
    <form action="{{route('lancamentos-por-genero')}}" method="get">
        <div class="campo-de-digitacao">
            <label for="">Data</label>
            <input type="date" name="data" id="data" value="{{date('Y-m-d')}}">
        </div>
        <div class="buttons">
            <button type="submit">Mostrar dados</button>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <td>Gênero</td>
                <td>Valor</td>
            </tr>
        </thead>
        <tbody>
            @foreach($generos as $genero)
            @if($genero->soma < 0)
            <tr>
                <td>{{$genero->genero}}</td>
                <td>R$ {{number_format(abs($genero->soma), 2, ',', '')}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection