@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Marca</h1>    
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
            <form action="{{ route('marca.search') }}" method="GET">
                <div class="input-group margin">
                    {!! csrf_field() !!}
                    <input class="form-control" type="text" id='description' name='description'/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
              </form>
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th colspan='2'>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($brands as $brand)
                    <tr>
                      <td>{{$brand->id}}</td>
                      <td>{{$brand->description}}</td>
                      <td with='100px'>
                        <a href='{{ route('marca.show', $brand->id) }}' class='btn btn-info'><span class='glyphicon glyphicon-eye-open'></span> Visualizar</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {!! $brands->links() !!}
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