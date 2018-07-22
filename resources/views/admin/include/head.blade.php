<!doctype html>

<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('/public/admin/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('/public/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/admin/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/public/admin/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/admin/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('/public/css/icheck-bootstrap.css')}}">
    
    <link rel="stylesheet" href="{{asset('/public/admin/css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{asset('/public/admin/scss/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

    <script type="text/javascript" src="{{asset('/public/js/ckeditor/ckeditor.js')}}"></script>
    
    <script src="{{asset('/public/admin/js/vendor/jquery-2.1.4.min.js')}}"></script>

    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
    
    <!-- <script type="text/javascript" src="{{asset('/public/js/ckfinder/ckfinder.js')}}"></script> -->

</head>
<body>
     @include('admin.categories.modal-insert')
