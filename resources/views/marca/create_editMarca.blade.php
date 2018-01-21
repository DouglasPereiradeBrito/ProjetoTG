@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Marca</h1>
    @include('includes.breadcrumb')
@stop

@section('content')
    @include('includes.alerts')
    <div class="box {{isset($brand->id) ? 'box-warning' : 'box-success'}}">
        <!--<div class="box-header with-border">
            <h3 class="box-title">Quick Example</h3>
        </div>-->
        @if(isset($brand->id))
            <form role="form" method='POST' action='{{route('marca.edit')}}'>
        @endif
        <form role="form" method='POST' action='{{route('marca.create')}}'>
            <div class="box-body">
                <div class="form-group {{isset($brand->id) ? '' : 'hidden'}}">
                    <label for="id">ID</label>
                    <input type="text" name='id' class="form-control" id="id" readonly value='{{$brand->id or old('id')}}'/>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" name='description' class="form-control" id="description" value='{{$brand->description or old("description")}}' />
                </div>                
                {!! csrf_field() !!}
                <div class="box-footer pull-right">
                    <button type="submit" class="btn {{isset($brand->id) ? 'btn-warning' : 'btn-success'}} "><span class='glyphicon {{isset($brand->id) ? 'glyphicon-refresh' : 'glyphicon-ok glyphicon'}}'></span>{{isset($brand->id) ? ' Alterar' : ' Cadastar'}}</button>
                    <a href='{{ route('marca.delete', isset($brand->id) ? $brand->id : '') }}' class="btn btn-danger {{isset($brand->id) ? '' : 'hidden'}}"><span class='glyphicon glyphicon-remove'></span> Excluir</a>
                </div>
            </div>
        </form>
    </div>    
@stop