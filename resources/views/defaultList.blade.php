@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ $title }}</h1>    
    @include('includes.breadcrumb')
@stop

@section('content')
    @include('includes.alerts')
    <div class="box">
      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <!--<div class="box-header with-border">
              <h3 class="box-title">Bordered Table</h3>
            </div>-->
            <div class="box-body">
              <form action="{{ route("$route.search") }}" method="GET">
                  <div class="form-group margin">
                    {!! csrf_field() !!}
                    <label>Nome</label>
                    <div class="input-group">
                      <input class="form-control" type="text" id='description' name='description'/>
                      <div class="input-group-btn">
                          <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Criado a</label>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-default" id="daterangeCriado-btn">
                          <span>
                              <i class="fa fa-calendar"></i> Selecione a Data
                          </span>
                          <i class="fa fa-caret-down"></i>
                        </button>
                      </div>
                      <input name='criado' id='criado' class="form-control" readonly/>
                    </div>
                  </div>
                  <div class="col-sm-6 form-group">
                    <label>Atualizado a</label>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-default" id="daterangeAtualizado-btn">
                          <span>
                              <i class="fa fa-calendar"></i> Selecione a Data
                          </span>
                          <i class="fa fa-caret-down"></i>
                        </button>
                      </div>
                      <input name='atualizado' id='atualizado' class="form-control" readonly/>
                    </div>
                  </div>
                  <div class="form-group pull-right">
                    <button type="submit" class="btn btn-default">Pesquisar</button>
                  </div>
              </form>
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                    @foreach($tables as $table)
                      <th>{{$table}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach($models as $model)
                    <tr>
                      <td>{{ $model->id }}</td>
                      <td>{{ $model->description }}</td>
                      @if(isset($model->brand, $model->session, $model->category, $model->gondola, $model->price))
                        <td>{{ $model->brand->description }}</td>
                        <td>{{ $model->session->description }}</td>
                        <td>{{ $model->category->description }}</td>
                        <td>{{ $model->gondola->description }}</td>
                        <td>R$ {{ $model->price }}</td>
                      @endif
                      <td>{{ $model->created_at }}</td>
                      <td>{{ $model->updated_at }}</td>
                      <td><a href='{{ route($route.'.show', $model->id) }}' class='btn btn-info'><span class='glyphicon glyphicon-eye-open'></span> Visualizar</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {!! $models->links() !!}
              </ul>
            </div>
          </div>
        </div>
      </div> 
    </div>  
    <!--data-toggle="modal" data-target="#modal-danger"<div class="modal modal-danger fade" id="modal-danger" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Exluir</h4>
            </div>
            <div class="modal-body">
              <p>Deseja realmente exluir este item ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Não</button>
              <a href=' route('marca.delete', $brand->id) ' class="btn btn-outline">Sim</a>
            </div>
          </div>
        </div>
    </div>-->
     
@stop