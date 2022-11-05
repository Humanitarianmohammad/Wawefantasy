<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->


<!-- Mirrored from www.pixinvent.com/materialize-material-design-admin-template/laravel/demo-1/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Feb 2022 14:23:25 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>
    <link rel="apple-touch-icon" href="{{ asset('/public/admin_assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/public/admin_assets/images/favicon/favicon-32x32.png') }}">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/vendors/vendors.min.css') }}">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/vendors/chartist-js/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/themes/vertical-modern-menu-template/style.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/pages/dashboard-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/pages/intro.css') }}">

    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/laravel-custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/custom/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/css/main.css') }}">
    <!-- END: Custom CSS-->

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    <script src="{{ asset('/public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/public/js/jquery.validate.min.js') }}" defer></script>
</head>
<!-- END: Head-->


<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">


    @include('layout-theme.header')
    @include('layout-theme.aside')

    <!-- BEGIN: Page Main-->
    <div id="main">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <!-- <button type="button btn-inline" class="close" data-dismiss="alert">
                <i class="material-icons right-align">clear</i>
            </button> -->
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <!-- <button type="button" class="close" data-dismiss="alert">
                <i class="material-icons right-align">clear</i>
            </button> -->
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
            <!-- <button type="button" class="close" data-dismiss="alert">
                <i class="material-icons right-align">clear</i>
            </button> -->
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block">
            <!-- <button type="button btn-inline" class="close" data-dismiss="alert">
                <i class="material-icons right-align">clear</i>
            </button> -->
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <!-- <button type="button" class="close" data-dismiss="alert">
                <i class="material-icons right-align">clear</i>
            </button> -->
            Please check the form below for errors
        </div>
        @endif

        {{ $slot }}
    </div>
    <!-- END: Page Main-->



    <!-- BEGIN: Footer-->
    <footer class="page-footer footer gradient-shadow  footer-static   footer-dark  gradient-shadow gradient-45deg-green-teal">
        <div class="footer-copyright">
            <div class="container">
                <span>&copy; 2022 <a href="#" target="_blank">Wawe Sustainability</a> All rights reserved.
                </span>
                <span class="right hide-on-small-only">
                    <a href="#">PlutoWeb</a>
                </span>
            </div>
        </div>
    </footer>

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('/public/admin_assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- <script src="{{ asset('/public/admin_assets/vendors/chartjs/chart.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/public/admin_assets/vendors/chartist-js/chartist.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/public/admin_assets/vendors/chartist-js/chartist-plugin-tooltip.js') }}"></script> -->
    <!-- <script src="{{ asset('/public/admin_assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}"></script> -->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('/public/admin_assets/js/plugins.js') }}"></script>
    <!-- <script src="{{ asset('/public/admin_assets/js/search.js') }}"></script> -->
    <script src="{{ asset('/public/admin_assets/js/custom/custom-script.js') }}"></script>
    {{-- <script src="{{ asset('/public/admin_assets/js/scripts/customizer.js') }}"></script> --}}
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="{{ asset('/public/admin_assets/js/scripts/dashboard-modern.js') }}"></script> -->
    <!-- <script src="{{ asset('/public/admin_assets/js/scripts/intro.js') }}"></script> -->
</body>

<!-- Mirrored from www.pixinvent.com/materialize-material-design-admin-template/laravel/demo-1/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Feb 2022 14:24:00 GMT -->

</html>