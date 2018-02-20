@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ $title }}</h1>
    @include('includes.breadcrumb')
@stop

@section('content')
    @include('includes.alerts')
    <div class="box {{isset($models->id) ? 'box-warning' : 'box-success'}}">
        @if(isset($models->id))
            <form role="form" method='POST' action='{{ route("$route.edit") }}'>   
        @else         
            <form role="form" method='POST' action='{{ route("$route.create") }}'>
        @endif
            <div class="box-body">
                <div class="form-group">
                    <button type="submit" class="btn {{ isset($models->id) ? 'btn-warning' : 'btn-success' }} "><span class='glyphicon {{ isset($models->id) ? 'glyphicon-refresh' : 'glyphicon-ok glyphicon' }}'></span>{{ isset($models->id) ? ' Alterar' : ' Cadastrar' }}</button>
                    <button type="submit" class="btn {{ isset($models->id) ? 'btn-warning' : 'btn-success' }} "><span class='glyphicon {{ isset($models->id) ? 'glyphicon-refresh' : 'glyphicon-ok glyphicon' }}'></span> Concluir</button>
                    <a href='{{ route("$route.delete", isset($models->id) ? $models->id : '') }}' class="btn btn-danger {{ isset($models->id) ? '' : 'hidden' }}"><span class='glyphicon glyphicon-remove'></span> Excluir</a>
                </div>
                @foreach($forms as $key => $form)
                    @if($key == 'product')
                        <div class="form-group col-sm-12 col-md-6">
                            <label>{{ $forms[$key][0] }}</label>
                            <select class="form-control select2 select2-hidden-accessible" name="{{ $key.'_id' }}" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @foreach($forms[$key][1] as $form)
                                    <option value='{{ $form->id }}' {{ isset($models->$key->id) && $models->$key->id == $form->id ? 'selected' : '' }}>{{ $form->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else  
                        <div class="form-group {{ !isset($models->id) && $key == 'id' ? 'hidden' : '' }}">
                            <label for="{{ $key }}">{{ $form }}</label>
                            <input type="text" name='{{ $key }}' class="form-control" id="{{ $key }}" {{ $key == 'id' && isset($models->id) ? 'readonly' : '' }} value='{{ $models->$key or old('$key') }}'/>
                        </div> 
                    @endif
                @endforeach      
                <div class="col-sm-12 col-md-6 form-group">
                    <label>Tags Cadastradas</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
                </div>
                {!! csrf_field() !!}
            </div>
        </form>
        <!--<form role="form" method='POST' action='{{ route("$route.create")}}'>
            <div class="box-body">
                <div class="form-group {{isset($model->id) ? '' : 'hidden'}}">
                    <label for="id">ID</label>
                    <input type="text" name='id' class="form-control" id="id" readonly value='{{$model->id or old('id')}}'/>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" name='description' class="form-control" id="description" value='{{$model->description or old("description")}}' />
                </div>                
                
                
            </div>
        </form>-->
    </div>    
@stop