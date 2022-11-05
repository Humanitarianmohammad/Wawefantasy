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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    {{-- <meta name="csrf-token" content="PQG74ZJEiERv80HNCMme5bhjqrR3HbxgufOe6DfK"> --}}

    <title>WAWE Sustainability</title>
    {{-- <link rel="apple-touch-icon" href="https://www.pixinvent.com/materialize-material-design-admin-template/laravel/demo-2/images/favicon/apple-touch-icon-152x152.png"> --}}
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('/public/admin_assets/images/favicon/favicon-32x32.png') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('/public/admin_assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/public/admin_assets/css/themes/vertical-modern-menu-template/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/pages/page-404.css') }}">

    <!-- END: Page Level CSS-->
</head>
<!-- END: Head-->

<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark 2-columns  bg-full-screen-image "
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <!--  main content -->
                <div class="section section-404 p-0 m-0 height-100vh">
                    <div class="row">
                        <!-- 404 -->
                        <div class="col s12 center-align white">
                            <img src="{{ asset('/public/admin_assets/images/gallery/error-2.png') }}"
                                class="bg-image-404" alt="">
                            <h1 class="error-code m-0">Welcome!!</h1>
                            <h6 class="mb-2">Please wait for the Admin approval</h6>
                            <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4"
                                href="{{ route('logout') }}">Back TO Login</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-overlay"></div>
        </div>
    </div>
    <script>
        $("#logoutbtn").click(function() {
            ("frmlogout").submit();
        });
    </script>
</body>

</html>
