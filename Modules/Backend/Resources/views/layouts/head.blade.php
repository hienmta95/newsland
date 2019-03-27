<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page_title')</title>
    <link rel="shortcut icon" type="image/ico" href="{{ cxl_asset("/images/favicon.ico") }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta content="{{ csrf_token() }}" name="csrf-token">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/dist/css/skins/_all-skins.css")}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fluidbox/2.0.0/css/fluidbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{cxl_asset("/backend/bower_components/jquery/jquery-ui.css")}}">
    <!-- jQuery 3 -->
    <script src="{{cxl_asset("/backend/bower_components/jquery/dist/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{cxl_asset("/backend/bower_components/jquery-ui/jquery-ui.min.js")}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <link href="{{ cxl_asset('/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/dist/css/AdminLTE.css")}}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/dist/css/custom.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/bower_components/font-awesome/css/font-awesome.css")}}">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="{{cxl_asset("/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
          <!-- Site style -->
    <link rel="stylesheet" href="{{cxl_asset("css/site.css")}}">
    <!-- Color Picker -->
    <link rel="stylesheet"
          href="{{cxl_asset("/backend/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css")}}">
    <!-- dataTables -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/dataTables/css/jquery.dataTables.min.css")}}">

    <!-- Dual List Box -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/dist/css/bootstrap-duallistbox.css")}}">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{cxl_asset("/backend/bower_components/select2/dist/css/select2.min.css")}}">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Datetime picker css -->
    <link rel="stylesheet" href="{{ cxl_asset('/backend/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" />
   <!-- select2 -->
    <link rel="stylesheet" href="{{ cxl_asset('/backend/bower_components/select2/dist/css/select2.min.css') }}" />
    <script src="//vjs.zencdn.net/4.11/video.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{cxl_asset("/backend/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{cxl_asset("/backend/dist/js/adminlte.min.js")}}"></script>
    <!-- dataTables -->
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- datetimepicker -->
    <script type="text/javascript" src="{{ cxl_asset('/backend/bower_components/moment/min/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ cxl_asset('/backend/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ cxl_asset('/backend/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>
    <script type="text/javascript"  src="{{ cxl_asset('/js/evaporate.js') }}"></script>
    <script type="text/javascript"  src="{{ cxl_asset('/js/backend_v1.js') }}"></script>

    <!-- bootstrap select -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{cxl_asset('/backend/plugins/iCheck/flat/grey.css')}}">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet"
          href="{{cxl_asset("/backend/bower_components/toastr/toastr.min.css")}}">
    <script type="text/javascript" src="{{ cxl_asset('/backend/bower_components/toastr/toastr.min.js') }}"></script>

    <!-- Dual List Box -->
    <script type="text/javascript" src="{{ cxl_asset('/backend/dist/js/jquery.bootstrap-duallistbox.js') }}"></script>

    <script type="text/javascript" src="{{ cxl_asset('/js/polyfill.min.js') }}"></script>
    <script src="{!! cxl_asset('/backend/bower_components/ckeditor/ckeditor.js') !!}"></script>

    @stack('css')

</head>
