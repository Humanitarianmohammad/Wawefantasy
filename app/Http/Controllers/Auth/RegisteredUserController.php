<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use Mail;
use App\Mail\verifyEmail;
use Exception;
use imritesh\Otp\Otp;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->user_type == 2) {
            $register_url = 'register_driver';
        } else if ($request->user_type == 3) {
            $register_url = 'user_dashboard';
        }
        // dd($request->mobile);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'role' => $request->user_type, //user Role
            'status' => $request->user_type == 2 ? 0 : 1, //If Driver, status(role = 2) is pending(0), other users will be active(1)
        ]);

        // dd($user);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect($register_url);
    }

    public function sendMobileOtp(Request $request)
    {

        $res['status'] = false;
        $res['message'] = 'Otp is invalid.';
        // echo($request->mobile);
        try {

            $exising_data = DB::table('users')->where(['mobile' => $request->mobile])
                ->first();

            if (empty($exising_data)) {

                $mobile_otp = rand(1231, 9999);
                $new = new Otp();
                
                $session = session(['mobile_otp' => $mobile_otp, 'mobile' => $request->mobile]);
                $new->sendOtp($request->mobile, $mobile_otp);

                // Mail::to($request->email)->send(new verifyEmail(Auth::user()->name, 0, $request->email, $email_otp));

                $res['status'] = true;
                $res['message'] = 'Otp is sent.';
                return json_encode($res);
            } else {
                $res['status'] = false;
                $res['message'] = 'Mobile is already in use.';
                return json_encode($res);
            }
        } catch (Exception $e) {
            report($e);
            $res['status'] = false;
            $res['message'] = 'something went wrong, Contact to admin';
            return json_encode($res);
        }
        return json_encode($res);
    }

    public function verifyMobileOtp(Request $request)
    {
        $res['status'] = false;
        $res['message'] = 'Otp is invalid.';

        if (!empty($request->mobile_otp)) {

            $otp = session('mobile_otp');
            // $phone = session('mobile');

            if ($request->mobile_otp == $otp) {

                $res['status'] = true;
                $res['message'] = 'Otp is verified.';
            }
        }
        return json_encode($res);
    }
}
