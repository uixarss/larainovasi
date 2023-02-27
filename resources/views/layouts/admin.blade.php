<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>{{ config('app.name', 'Litbang') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('admin-bsb/favicon.ico') }}" type="image/x-icon" />
    <!-- END META SECTION -->


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- fontawesome Icons -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin-bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin-bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('admin-bsb/plugins/morrisjs/morris.css') }}" rel="stylesheet" />


    @yield('css-add')

    <!-- Custom Css -->
    <link href="{{ asset('admin-bsb/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-bsb/css/mystyle.css') }}" rel="stylesheet">

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('admin-bsb/css/themes/all-themes.css') }}" />

    <!-- EOF CSS INCLUDE -->


</head>

<body class="theme-light-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->


    @include('layouts.includes._navbar')

    <section>
        @include('layouts.includes._sidebar')
    </section>


    <section class="content">

        @yield('content')

    </section>


    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin-bsb/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/node-waves/waves.js') }}"></script>



    @yield('data-scripts')
    @yield('js')


</body>

</html>
