<x-user-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/admin_assets/css/pages/page-account-settings.css') }}">
    <style>
        .general-action-btn {
            position: relative;
        }
        .verified_icon{
            float: left;
            color: #03CBC9;
        }
    </style>

    <div class="row">
        <div class="content-wrapper-before gradient-45deg-green-teal">
        </div>

        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Profile Settings </span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('user_dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: white">Profile Settings </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12">
            <div class="container">
                <section class="tabs-vertical mt-1 section">
                    <div class="row">
                        <div class="col l4 s12">
                            <!-- tabs  -->
                            <div class="card-panel">
                                <ul class="tabs">
                                    <li class="tab">
                                        <a href="#verify_email">
                                            <i class="material-icons">verified_user</i>
                                            <span>Personal details</span>
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a href="#change-password">
                                            <i class="material-icons">person</i>
                                            <span>View details</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col l8 s12">
                            <form method="POST" id="mai_verify_form" enctype="multipart/form-data"
                                action="{{ URL('verify_user_mail') }}">
                                @csrf

                                <div id="verify_email">
                                    <div class="card-panel">
                                        <div class="display-flex">
                                            <div class="row flexClass" style="width: 100%">
                                                <div class="col s12 m9 alignSelfCenter">
                                                    <div class="input-field">
                                                        <input id="email" name="email" type="email"
                                                            value="{{ Auth::user()->email }}">
                                                        <label for="email">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m3 right-align alignSelfCenter">
                                                    <input type="hidden" value="0" name="email_verified"
                                                        id="email_verified">
                                                    <div class="flex items-center justify-end mt-1">
                                                        @if (Auth::user()->email_verified == 0)
                                                            <button class="waves-effect waves-light btn" id="verify_email_btn" type="button">
                                                                Verify
                                                            </button>
                                                        @else
                                                            <i class="material-icons profile-card-i verified_icon">verified</i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 alignSelfCenter">
                                                <div class="input-field">
                                                    <input id="address" name="address" type="text"
                                                        value="{{ Auth::user()->address }}">
                                                    <label for="address">Address</label>
                                                </div>
                                            </div>
                                            <div class="col s12 m12 alignSelfCenter">
                                                <div class="input-field">
                                                    <input id="pincode" name="pincode" type="number"
                                                        value="{{ Auth::user()->pincode }}">
                                                    <label for="pincode">Pincode</label>
                                                </div>
                                            </div>
                                            <div class="col s12 m12 alignSelfCenter">
                                                <button
                                                    class="waves-effect waves-light btn gradient-45deg-green-teal box-shadow"
                                                    type="submit" style="float: right;">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="change-password">
                                <div class="card-panel">
                                    <div class="display-flex">
                                        <div class="row" style="width: 100%">
                                            <div class="col s12 m10 l8">
                                                <div id="profile-card" class="card animate fadeRight"
                                                    style="overflow: visible;">
                                                    <div class="card-image waves-effect waves-block waves-light">
                                                        <img class="activator"
                                                            src="https://www.pixinvent.com/materialize-material-design-admin-template/laravel/demo-2/images/gallery/3.png"
                                                            alt="user bg">
                                                    </div>
                                                    <div class="card-content">
                                                        <img src="https://www.pixinvent.com/materialize-material-design-admin-template/laravel/demo-2/images/avatar/avatar-7.png"
                                                            alt=""
                                                            class="circle responsive-img activator card-profile-image cyan lighten-1 padding-2">
                                                        {{-- <a
                                                            class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                                                            <i class="material-icons">edit</i>
                                                        </a> --}}
                                                        <h5 class="card-title activator grey-text text-darken-4">
                                                            {{ $users_data->name }}</h5>
                                                        <p>
                                                            <i class="material-icons profile-card-i">perm_identity</i>
                                                            @if ($users_data->role == 1)
                                                                Admin
                                                            @elseif($users_data->role == 2)
                                                                Pick-up agent
                                                            @elseif($users_data->role == 3)
                                                                User
                                                            @endif
                                                        </p>
                                                        <p>
                                                            <i class="material-icons profile-card-i">perm_phone_msg</i>
                                                            {{ $users_data->mobile }}
                                                        </p>
                                                        <p>
                                                            <i class="material-icons profile-card-i">email</i>
                                                            {{ $users_data->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- The Modal -->
                        <div class="modal" id="verifyemailModel">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col s7 m7">
                                                <h5 class="modal-title">Verify Email</h5>
                                            </div>
                                            <div class="col s5 m5">
                                                <button class="btn-floating mb-1 waves-effect waves-light close"
                                                    type="button" data-dismiss="modal" style="float: right;">
                                                    <i class="material-icons">clear</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <!-- OTP -->
                                        <div class="mt-4">
                                            <label for="email_otp">
                                                <input id="email_otp" class="block mt-1 w-full" type="text"
                                                    name="email_otp">
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <div class="row flexClass">
                                            <div class="col s6 m6 alignSelfCenter" style="text-align: center;">
                                                <button type="button" id="resend_email_otp"
                                                    class="waves-effect waves-light btn gradient-45deg-green-teal box-shadow">
                                                    Resend OTP
                                                </button>
                                                <div class="countdown"></div>
                                            </div>
                                            <div class="col s6 m6 alignSelfCenter" style="text-align: center;">
                                                <button type="submit" id="submit_email_otp"
                                                    class="waves-effect waves-light btn gradient-45deg-green-teal box-shadow">
                                                    Verify OTP
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/js/custom/user-profile.js') }}" defer></script>
</x-user-layout>
