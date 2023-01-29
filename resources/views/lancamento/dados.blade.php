@extends('paginaAutenticada')

@section('allowed-content')

<div class="form">
    <h1>Dados</h1>
    <form action="{{route('dados')}}" method="get">
        <div class="campo-de-digitacao">
            <label for="">Data</label>
            <input type="date" name="data" id="data" value="{{date('Y-m-d')}}">
        </div>
        <div class="buttons">
            <button type="submit">Mostrar dados</button>
        </div>
    </form>
    <table>
        <tbody>
            @foreach($dados as $dado)
            <tr>
                <td>{{$dado[0]}}</td>
                <td>R$ {{number_format(abs($dado[1]), 2, ',', '')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection