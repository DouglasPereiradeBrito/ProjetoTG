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
            <div class="box-body">
              <form action="{{ route("$route.search") }}" method="GET">
                <!--@if($title === 'Historico') 
                  <div class='col-sm-12 col-md-6'>
                @endif-->
                  <div class="form-group {{ $title == 'Historico' ? 'col-sm-6' : 'margin' }}">
                    {!! csrf_field() !!}
                    <label>Nome</label>
                    <input class="form-control" type="text" id='description' name='description'/>
                  </div>
                  @if(isset($brands, $sessions))
                    <div class="col-sm-3 form-group {{ $title === 'Historico' ? '' : 'hidden' }}">
                      <label>Marca</label>
                        <select class="form-control select2 select2-hidden-accessible" name="brand" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option select='true'></option>
                          @foreach($brands as $brand)
                            <option value='{{ $brand->description }}'>{{ $brand->description }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 form-group {{ $title === 'Historico' ? '' : 'hidden' }}">
                      <label>Sessão</label>
                      <select class="form-control select2 select2-hidden-accessible" name="session" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option select='true'></option>
                        @foreach($sessions as $session)
                          <option value='{{ $session->description }}'>{{ $session->description }}</option>
                        @endforeach
                      </select>
                    </div>
                  @endif

                  <div class="form-group {{ $title == 'Historico' ? 'col-sm-6' : 'col-sm-6' }}">
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
                  <div class="col-sm-6 form-group {{ $title === 'Historico' ? 'hidden' : '' }}">
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
                  <!--@if($title === 'Historico') 
                    </div>
                  @endif-->
                @if(isset($categories, $gondolas))
                  <div class="col-sm-3 form-group {{ $title === 'Historico' ? '' : 'hidden' }}">
                    <label>Categoria</label>
                    <select class="form-control select2 select2-hidden-accessible" name="category" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option select='true'></option>
                      @foreach($categories as $category)
                        <option value='{{ $category->description }}'>{{ $category->description }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-3 form-group {{ $title === 'Historico' ? '' : 'hidden' }}">
                    <label>Gôndola</label>
                    <select class="form-control select2 select2-hidden-accessible" name="gondola" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option select='true'></option>
                      @foreach($gondolas as $gondola)
                        <option value='{{ $gondola->description }}'>{{ $gondola->description }}</option>
                      @endforeach
                    </select>
                  </div>
                @endif
                  <div class="form-group pull-right">
                    <button type="submit" class="btn btn-default">Pesquisar</button>
                  </div>
              </form>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="box">
      <div class="row">
        <div class="col-sm-12">
          <div class="box table-bordered table-responsive no-padding">
            <div class="box-body">
              <table class="table">
                <thead>
                  @if($title === 'Historico')
                    <tr>
                      @foreach($tables as $key => $table)
                        <th colspan='{{ $table }}' class='text-center'>{{ $key }}</th>
                      @endforeach
                    </tr>
                  @else
                    @foreach($tables as $table)
                      <th class='text-center'>{{ $table }}</th>
                    @endforeach
                  @endif
                  @if($title === 'Historico')
                    <tr>
                      <th colspan='' class='text-center'>ID</th>
                      <th colspan='' class='text-center'>Ação feita por</th>
                      <th colspan='2' class='text-center'>Descrição</th>
                      <th colspan='2' class='text-center'>Preço</th>
                      <th colspan='2' class='text-center'>Descrição</th>
                      <th colspan='2' class='text-center'>Descrição</th>
                      <th colspan='2' class='text-center'>Descrição</th>
                      <th colspan='2' class='text-center'>Descrição</th>
                      <th colspan='1' class='text-center'>Criado</th>
                    </tr>
                  @endif
                </thead>
                <tbody>
                  @foreach($models as $model)
                    <tr>
                      <td>{{ $model->id }}</td>
                      <td {{ isset($model->description) ? '' : 'hidden' }}>{{ $model->description }}</td>
                      @if(isset($model->brand, $model->session, $model->category, $model->gondola, $model->price))
                        <td>{{ $model->brand->description }}</td>
                        <td>{{ $model->session->description }}</td>
                        <td>{{ $model->category->description }}</td>
                        <td>{{ $model->gondola->description }}</td>
                        <td>R$ {{ $model->price }}</td>
                      @elseif($title === 'Historico')
                        <td>{{ $model->user->name }}</td>
                        <td>{{ $model->product_before_description }}</td>
                        <td>{{ $model->product_after_description }}</td>
                        <td>R$ {{ $model->product_before_price }}</td>
                        <td>R$ {{ $model->product_after_price }}</td>
                        <td>{{ $model->brand_before_description }}</td>
                        <td>{{ $model->brand_after_description }}</td>
                        <td>{{ $model->gondola_before_description }}</td>
                        <td>{{ $model->gondola_after_description }}</td>
                        <td>{{ $model->category_before_description  }}</td>
                        <td>{{ $model->category_after_description }}</td>
                        <td>{{ $model->session_before_description }}</td>
                        <td>{{ $model->session_after_description }}</td> 
                      @endif
                      <td>{{ $model->created_at }}</td>
                      @if($title !== 'Historico')
                        <td>{{ $model->updated_at }}</td>
                        <td><a href='{{ route($route.'.show', $model->id) }}' class='btn btn-info'><span class='glyphicon glyphicon-eye-open'></span> Visualizar</a></td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              {!! $models->links() !!}
            </ul>
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