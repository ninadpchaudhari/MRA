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

    {{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
    <link rel="stylesheet" href="/font/material-icons/material-icons.css">
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="indigo">
    <div class="nav-wrapper ">
        <div class="row">
            <div class="col s2"><img src="/images/logo-small.png" alt="" class="logo-container"></div>
            <div class="col s10">
                <a href="#" class="brand-logo">National Rifle Association of India</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html">Circulars</a></li>

                    <li><a href="collapsible.html">Contact Us</a></li>

                </ul>
            </div>
        </div>


    </div>
</nav>


<div class="container">
    @yield('content')

</div>





<script src="/js/vendor-no-vue.js"></script>
@yield('footer')
{{--<script src="js/app.js"></script>--}}
{{--
 When in Production add versioning
 <script src="{{elixir('js/app.js')}}"></script> --><!-- Google Analytics: change UA-XXXXX-X to be your site's ID.
 --}}
        <!--
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
-->
</body>
</html>