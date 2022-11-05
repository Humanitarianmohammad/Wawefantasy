<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if(Auth::user()->role == 1){
            $dashboard_url = 'admin_dashboard';
        }else if(Auth::user()->role == 3){
            $dashboard_url = 'user_dashboard';
        }else if(Auth::user()->role == 2 && Auth::user()->status == 1){
            $dashboard_url = 'driver_dashboard';
        }else if(Auth::user()->role == 2 && Auth::user()->status == 0){
            $dashboard_url = 'pending_driver';
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect($dashboard_url);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
