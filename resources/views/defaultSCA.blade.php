
@extends('adminlte::page')

@section('content_header')
    <h1>{{ $title }}</h1>
    @include('includes.breadcrumb')
@stop

@section('content')
    @include('includes.alerts')
    @if(isset($models->id))
        <form role="form" method='POST' action='{{ route("$route.edit") }}'>   
    @else         
        <form role="form" method='POST' action='{{ route("$route.create") }}'>
    @endif
    <div class="box {{isset($models->id) ? 'box-warning' : 'box-success'}}">
        <div class="box-body">
            <button type="submit" class="btn btn-app {{ isset($models->id) ? 'bg-orange' : 'bg-green' }}"><i class="{{ isset($models->id) ? 'glyphicon glyphicon-refresh' : 'fa fa-save' }}"></i> {{ isset($models->id) ? ' Alterar' : ' Cadastrar' }}</button>
            <a href='{{ route("$route.delete", isset($models->id) ? $models->id : '') }}' class="btn btn-app bg-red {{ auth()->user()->can('SCA') && isset($models->id) ? '' : 'hidden' }}"><span class='glyphicon glyphicon-remove'></span> Excluir</a>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
        @foreach($forms as $key => $form)
            @if($key == "session" || $key == 'brand' || $key == 'gondola' || $key == 'category')
                <div class="form-group col-sm-12 col-md-6">
                    <label>{{ $forms[$key][0] }}</label>
                    <select class="form-control select2 select2-hidden-accessible" name="{{ $key.'_id' }}" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        @foreach($forms[$key][1] as $form)
                            <option value='{{ $form->id }}' {{ isset($models->$key->id) && $models->$key->id == $form->id ? 'selected' : '' }}>{{ $form->description }}</option>
                        @endforeach
                    </select>
                </div>
            @else  
                <div class="form-group {{ !isset($models->id) && $key == 'id' ? 'hidden' : '' }} has-feedback {{ $errors->has("$key") ? 'has-error' : '' }}">
                    <label for="{{ $key }}">{{ $form }}</label>
                    
                    <input type="{{ $key == 'password' ? 'password' : 'text' }}" name='{{ $key }}' class="form-control" id="{{ $key }}" {{ $key == 'id' && isset($models->id) ? 'readonly' : '' }}  value="{{ $key == 'password' ? old("$key") : isset($models) ? $models->$key : ''}}"/>
                    @if ($errors->has("$key"))
                        <span class="help-block">
                            <strong>{{ $errors->first("$key") }}</strong>
                        </span>
                    @endif
                </div> 
            @endif
        @endforeach
        @if(auth()->user()->can('SCA') && $route == 'usuario')
            <div class="form-group col-sm-12">
                <label>{{ $roles[0] }}</label>
                <select class="form-control select2 select2-hidden-accessible" name="role" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    @foreach($roles[1] as $op)
                        <option value='{{ $op->id }}' {{ isset($models->usersRoles[0]->role_id) && $models->usersRoles[0]->role_id == $op->id ? 'selected' : ''}}>{{ $op->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        {!! csrf_field() !!}
        </div>
    </div>    
    </form>
@stop