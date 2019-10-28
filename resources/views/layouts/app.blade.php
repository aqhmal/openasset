@php
$theme = \App\Setting::where('option', 'theme')->first();
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - {{ config('app.name', 'Marketer Management System') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
        <!-- Pace -->
        <link rel="stylesheet" href="{{ asset('plugins/pace/pace.min.css') }}">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @yield('post-head')
    </head>
    <body class="hold-transition skin-{{ $theme->value }} sidebar-mini">
        @yield('content')
        <!-- jQuery 3 -->
        <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('vendor/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('vendor/jquery-knob/dist/jquery.knob.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <!-- datepicker -->
        <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('vendor/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <!-- DataTables -->
        <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
        <!-- Sweetalert -->
        <script type="text/javascript" src="{{ asset('vendor/sweetalert/dist/sweetalert.min.js') }}"></script>
        <!-- Pace -->
        <script src="{{ asset('vendor/PACE/pace.min.js') }}"></script>
        @yield('post-scripts')
    </body>
</html>
