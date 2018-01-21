@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Categoria</h1>
    @include('includes.breadcrumb')
@stop

@section('content')
    @include('includes.alerts')
    <div class="box {{isset($categories->id) ? 'box-warning' : 'box-success'}}">
        <!--<div class="box-header with-border">
            <h3 class="box-title">Quick Example</h3>
        </div>-->
        @if(isset($categories->id))
            <form role="form" method='POST' action='{{route('categoria.edit')}}'>
        @endif
        <form role="form" method='POST' action='{{route('categoria.create')}}'>
            <div class="box-body">
                <div class="form-group {{isset($categories->id) ? '' : 'hidden'}}">
                    <label for="id">ID</label>
                    <input type="text" name='id' class="form-control" id="id" readonly value='{{$categories->id or old('id')}}'/>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" name='description' class="form-control" id="description" value='{{$categories->description or old("description")}}' />
                </div>                
                {!! csrf_field() !!}
                <div class="box-footer pull-right">
                    <button type="submit" class="btn {{isset($categories->id) ? 'btn-warning' : 'btn-success'}} "><span class='glyphicon {{isset($categories->id) ? 'glyphicon-refresh' : 'glyphicon-ok glyphicon'}}'></span>{{isset($categories->id) ? ' Alterar' : ' Cadastrar'}}</button>
                    <a href='{{ route('marca.delete', isset($categories->id) ? $categories->id : '') }}' class="btn btn-danger {{isset($categories->id) ? '' : 'hidden'}}"><span class='glyphicon glyphicon-remove'></span> Excluir</a>
                </div>
            </div>
        </form>
    </div>    
@stop