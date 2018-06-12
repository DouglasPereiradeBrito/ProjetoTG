@extends('adminlte::page')

@section('title', 'PrateleiraDigital')

@section('content_header')
    <h1>Notificações</h1>
    @include('includes.breadcrumb')
@stop

@section('content')
    @include('includes.alerts')
    <section class="content">
        <div class="row">
          <div class="col-md-12">
                @if(!empty($datas[0]))
                    <ul class="timeline">  
                        <li class="time-label">
                            <span class="bg-red">{{ $datas[0]->created_at->format('d/m/Y') }}</span>
                        </li>
                        @foreach($datas as $data)
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time">  <i class="glyphicon glyphicon-hand-right"> </i> <a href="{{ route('notification.delete',  $data->id) }}" class="btn btn-warning btn-xs">Modificação Feita</a></span>
                                    <h3 class="timeline-header no-border">{{ $data->description }}</h3>
                                </div>
                            </li>
                        @endforeach
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                @endif  
          </div>
        </div>  
       </section>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/request.js') }}"></script>
    <!--<script src="{{ asset('vendor/adminlte/dist/js/paginate.js') }}"></script>-->
@stop