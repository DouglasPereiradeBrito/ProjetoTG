
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
    @yield('title', config('adminlte.title', 'PrateleiraDigital'))
    @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/app.css') }}">

        @if(config('adminlte.plugins.select2'))
            <!-- Select2 -->
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/cdnjs.cloudflare.com_ajax_libs_select2_4.0.3_css_select2.css') }}">
        @endif

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

        @if(config('adminlte.plugins.datatables'))
            <!-- DataTables -->
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/cdn.datatables.net_1.10.15_css_jquery.dataTables.min.css') }}">
        @endif

        @yield('adminlte_css')

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/fonts.googleapis.css') }}">
    </head>
    <body class="hold-transition @yield('body_class') ">

    @yield('body')

    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        <script src="{{ asset('vendor/adminlte/dist/js/select2.full.min.js') }}"></script>
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>-->
    @endif

    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables -->
        <script src="{{ asset('vendor/adminlte/dist/js/cdn.datatables.net_1.10.15_js_jquery.dataTables.min.js') }}"></script>
        <!--<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->
    @endif

    @if(config('adminlte.plugins.chartjs'))
        <!-- ChartJS -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    @endif

    @yield('adminlte_js')
        
    </body>
    </html>
