<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NRAI Forms</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->


    <!-- Traditional-->
    <link rel="stylesheet" href="{{ asset(url('css/vendor.css')) }}">

    <!-- Production -->
    {{-- <link rel="stylesheet" href="{{ elixir('css/app.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset(url('css/app.css')) }}">
    <style type="text/css">
        .page {
            overflow: hidden;
            page-break-after: always;
        }
    </style>

    {{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
    <link rel="stylesheet" href="/font/material-icons/material-icons.css">
    @yield('head')
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->




    @yield('content')




<script src="/js/vendor.js"></script>
@yield('footer')
{{--
<div class="page-footer center">
    <h6>Data Management Managed by Ninad I.T.Services</h6>
</div>
--}}



</body>
</html>