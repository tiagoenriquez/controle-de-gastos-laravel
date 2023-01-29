@extends('index')

@section('content')

@if(isset($token))

@include('menu')

@yield('allowed-content')

@endif

@endsection