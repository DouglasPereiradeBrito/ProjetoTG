@extends('adminlte::page')

@section('title', 'PrateleiraDigital')

@section('content_header')
    <h1>{{ $title }}</h1>
    @include('includes.breadcrumb')

@stop

@section('content')
    @include('includes.alerts')
       
        <div class="box">
                <div class="box-body">
                <div class="col-sm-12 col-md-6">
                    @foreach($forms as $key => $form)
                        @if($key == 'product')
                            <label>{{ $forms[$key][0] }}</label>
                            <select id="product" onchange="ListarIds();" class="form-control select2 select2-hidden-accessible" name="{{ $key.'_id' }}" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @foreach($forms[$key][1] as $form)
                                    <option value='{{ $form->id }}' {{ isset($models->$key->id) && $models->$key->id == $form->id ? 'selected' : '' }}>{{ $form->description }}</option>
                                @endforeach
                            </select>
                        @else  
                            <div class="form-group {{ !isset($models->id) && $key == 'id' ? 'hidden' : '' }}">
                                <label for="{{ $key }}">{{ $form }}</label>
                                <input type="text" name='{{ $key }}' class="form-control" id="{{ $key }}" {{ $key == 'id' && isset($models->id) ? 'readonly' : '' }} value='{{ $models->$key or old('$key') }}'/>
                            </div> 
                        @endif
                    @endforeach 
                </div>
                <div class="col-sm-12 col-md-6">
                    <label></label>
                    <div class="box">
                        <div class="box-header">
                            <span class="box-title text-left">Tags Cadastradas</span>
                            <div class="box-tools pull-right">
                                <strong><span class="align-middle" id="total"></span></strong>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody id="lista">
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix" id="paginate">
                        
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-11 col-md-11 offset-sm-11 offset-md-11"></div>
                <div class="col-sm-3 col-md-1">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-info">+</button>
                    <!--<button type="button" data-toggle="modal" data-target="#modal-verify"></button>-->
                </div>       
                </div>
                {!! csrf_field() !!}
            <div class="overlay hidden" id="teste">
                <i class="fa fa-refresh fa-spin"></i>
            </div> 
        </div>    

            <div class="modal modal-success fade" id="modal-info" style="display: none;">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-center">Cadastro de Tags</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-white">Aproxime as tags no leitor para cadastrá-las</p>
                        <div class="row">
                            <div class="col-sm-2 col-md-4 offset-sm-2 offset-md-4"></div>
                            <div class="col-sm-8 col-md-8">
                                <div class="col-sm-5 offset-sm-5"></div>
                                <div class="col-sm-12 col-md-11">
                                    <button id="start" onclick="makeRequestFull();start();$('#load').addClass('overlay').removeClass('hidden');$('#start').addClass('hidden');$('#stop').removeClass('hidden');" class="btn btn-info">Iniciar Leitura</button>
                                    <button onclick="terminar();$('#start').removeClass('hidden');$('#stop').addClass('hidden');$('#load').addClass('hidden');" id="stop" class="btn btn-danger hidden">Finalizar Leitura</button>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="box"  style="height: 100px">
                                <div class="box-body" id="list-group">
                                        
                                    </ul>
                                </div>
                            </div>
                        <div class="hidden" id="load">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                        <a href='#' onclick="create()" class="btn btn-outline">Cadastrar</a>
                    </div>
                </div>
                </div>
            </div>

            <!--///////////////////////////////////////////////////////////////////////////////////-->
            <div class="modal modal-warning fade" id="modal-verify" style="display: none;">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-center">Tag já Cadastrada</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Deseja Alterar a Tag ?</p>
                        <div> 
                            <p class="text-center">Selecione um novo produto para tag.</p>
                            <label class="text-center" style="text-align: center">Produtos</label>
                            <select id="tag-verify" class="form-control select2 select2-hidden-accessible" name="{{ $key.'_id' }}" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                
                            </select>
                    </div>
                    <div class="box-body" id="tag">
                            <div class="offset-sm-0 col-md-4 offset-md-4"></div><li class="list-group-item col-sm-12 col-md-4 text-muted text-center"><i class="icon fa fa-tags"></i> 04837c5a314d80</li>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-outline">Alterar</button>
                    </div>
                </div>
                </div>
            </div>
            
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/request.js') }}"></script>
    <!--<script src="{{ asset('vendor/adminlte/dist/js/paginate.js') }}"></script>-->
@stop