@extends('adminlte::master')
@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
    <p>akjldksa</p>
    
@stop
@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/request.js') }}"></script>
<script>lcd('{!! $nome !!}','{!! $preco !!}');</script>
@stop