
@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/fundologincss/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/fundologincss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/login.css') }}">
@stop

@section('body')
    <div id="particles-js"></div>
    
            
        
        <div class="count-particle">
                
            <div class="container">
                    
                <div class="login-container">
                    <div id="output"></div> 
                    
                        
                        <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
                    <div class="form-box">
                        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                            {!! csrf_field() !!}
                            
                                <input type="email" name="email" class="" value="{{ old('email') }}"
                                       placeholder="{{ trans('adminlte::adminlte.email') }}">
                                
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                                <input type="password" name="password" class=""
                                       placeholder="{{ trans('adminlte::adminlte.password') }}">
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <div class="form-group">
                                <button class="btn btn-info btn-block login" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- scripts -->
        <script src="{{ asset('vendor/adminlte/dist/js/fundologinjs/particles.js') }}"></script>        
        <script src="{{ asset('vendor/adminlte/dist/js/fundologinjs/app.js') }}"></script>        
        <script src="{{ asset('vendor/adminlte/dist/js/fundologinjs/lib/stats.js') }}"></script>        


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/dist/js/popper.min.js') }}"></script>        
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
