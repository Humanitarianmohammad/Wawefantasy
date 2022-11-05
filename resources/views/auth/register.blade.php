<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" id="frmRegister" action="{{ route('register') }}">
            @csrf

            {{-- Type --}}
            <div>
                <x-label for="user_type" :value="__('User type')" />
                <select name="user_type" id="user_type" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    <option value="3">User</option>
                    <option value="2">Driver</option>
                </select>
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile')" />

                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')"
                    required />
                {{-- <input type="hidden" value="" name="email_otp" id="email_otp_txt"> --}}
                <input type="hidden" value="0" name="email_verified" id="email_verified">
                <div class="flex items-center justify-end mt-1">
                    <x-button class="text-right" id="verify_email_btn" type="button">
                        Verify
                    </x-button>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="verifyemailModel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Verify Mobile</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <!-- OTP -->
                            <div class="mt-4">
                                <x-label for="mobile_otp" :value="__('OTP')" />

                                <x-input id="mobile_otp" class="block mt-1 w-full" type="text" name="mobile_otp"
                                    :value="old('mobile_otp')" />
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-6 ">
                                    <button type="button" class="sign_in_normal_btn sign_in_common"
                                        id="resend_mobile_otp">Resend OTP</button>
                                    <div class="countdown"></div>
                                </div>
                                <div class="col-6 ">
                                    <button type="button" class="sign_in_red_btn sign_in_common"
                                        id="submit_mobile_otp">Verify OTP</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/js/custom/register.js') }}" defer></script>
</x-guest-layout>
