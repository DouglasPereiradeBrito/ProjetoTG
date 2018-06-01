@extends('adminlte::page')

@section('title', 'PrateleiraDigital')

@section('content_header')
    
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 style="font-size: 50px" class="text-center">Bem Vindo</h1>
            <h1 class="text-center text-green" style="font-size: 50px"><b>{{ auth()->user()->name }}</b></h1>
        </div>
    </div>
@stop