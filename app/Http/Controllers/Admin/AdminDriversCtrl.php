<?php

namespace App\Http\Controllers\Admin;

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

class AdminDriversCtrl extends Controller
{
    public function drivers_list()
    {
        $users = DB::table('users')
            ->where('users.role', '=', 2)
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.drivers-list',
            compact(
                'users',
            )
        );
    }

    public function approve_user($id)
    {
        $table = DB::table('users')
                ->where('id', $id)
                ->update([
                    'status' => 1,
                ]);

        // return redirect('/vendor_list');
        return back()->with('success', 'User is approved successfully');
    }
}
