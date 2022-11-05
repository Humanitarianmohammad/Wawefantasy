<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
// use Mail;
use App\Mail\verifyEmail;
// use Vendor\imritesh\Otp\src\Otp;


class UserProfileCtrl extends Controller
{
    public function user_profile()
    {
        $data = '';
        $base_url = url('/');

        $users_data = DB::table('users')
            // ->leftJoin('file_manage', 'users.profile_img', '=', 'file_manage.fid')
            ->where('users.id', '=', Auth::user()->id)
            ->first();

        return view(
            'user.user-profile',
            compact(
                'base_url',
                'users_data',
            )
        );
    }

    public function sendEmailOtp(Request $request)
    {

        $res['status'] = false;
        $res['message'] = 'Otp is invalid.';

        try {

            $exising_data = DB::table('users')->where(['email' => $request->email])
                ->first();

            // echo($exising_data);
            if (empty($exising_data)) {

                $email_otp = rand(1231, 9999);
                $session = session(['email_otp' => $email_otp, 'email' => $request->email]);

                Mail::to($request->email)->send(new verifyEmail(Auth::user()->name, Auth::user()->id, $request->email, $email_otp));

                $res['status'] = true;
                $res['message'] = 'Otp is sent.';
                // $res['message'] = $request->name;
                return json_encode($res);
            } else {
                $res['status'] = false;
                $res['message'] = 'Email id is already in use.';
                return json_encode($res);
            }
        } catch (Exception $e) {
            echo ($e);
            $res['status'] = false;
            $res['message'] = 'something went wrong, Contact to admin';
            return json_encode($res);
        }
    }

    public function verifyEmailOtp(Request $request)
    {
        // $request->validate([
        //     'email_otp' => ['required'],
        // ]);

        $res['status'] = false;
        $res['message'] = 'Otp is invalid.';

        if (!empty($request->email_otp)) {

            $otp = session('email_otp');
            // $phone = session('mobile');

            if ($request->email_otp == $otp) {

                // $table = DB::table('users')
                //     ->where('id', Auth::user()->id)
                //     ->update([
                //         'email_verified' => 1,
                //     ]);

                $res['status'] = true;
                $res['message'] = 'Otp is verified.';
            }
            // $user_id = DB::table('users')->where([
            //     ['mobile_otp', '=', $request->mobile_otp],
            //     ['mobile', '=', $request->mobile]
            // ])->value('id');
        }
        return json_encode($res);
    }

    public function verify_user_mail(Request $request)
    {
        if ($request->email_verified == 1) {
            $table = DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'email' => $request->email,
                    'email_verified' => 1,
                ]);
        }

        $table = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'address' => $request->address,
                'pincode' => $request->pincode,
            ]);
        return back()->with('success', 'Profile Updated successfully');
    }
}
