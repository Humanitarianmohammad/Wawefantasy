<?php

namespace App\Http\Controllers\Driver;

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
use App\Mail\orderComplete;

class DriverOrderCtrl extends Controller
{
    public function agent_order_list()
    {
        $data = DB::table('user_orders')
            ->leftJoin('payment_methods', 'user_orders.pmid', '=', 'payment_methods.pmid')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->leftJoin('users', 'user_orders.uid', '=', 'users.id')
            ->select('products.*', 'user_orders.*', 'user_orders.status as user_status', 'users.name', 'users.mobile', 'payment_methods.payment_type')
            // ->where('user_orders.status', '=', 0)
            ->where('user_orders.agent_id', '=', Auth::user()->id)
            ->orderBy('user_orders.oid', 'desc')
            ->get();
        $drivers = DB::table('users')
            ->where('users.status', '=', 1)
            ->where('users.role', '=', 2)
            ->get();

        return view(
            'driver.driver-order-list',
            compact(
                'data',
                'drivers',
            )
        );
    }

    public function accept_order($oid)
    {
        $data = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->where('user_orders.oid', '=', $oid)
            ->where('products.status', '=', 0)
            ->first();

        $payment_methods = DB::table('payment_methods')
            ->where('payment_methods.status', '=', 0)
            ->get();

        return view(
            'driver.accept-order',
            compact(
                'data',
                'payment_methods',
            )
        );
    }

    public function confirm_pickup(Request $request)
    {
        $table = DB::table('user_orders')
            ->where('oid', $request->oid)
            ->update([
                'weight' => $request->final_weight,
                'rate' => $request->rate,
                'amount' => $request->amount,
                'pmid' => $request->pmid,
                'picked_on' => time(),
                'status' => 2,
            ]);

        $orderDetails = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->leftJoin('users as A', 'user_orders.uid', '=', 'A.id')
            ->leftJoin('users as B', 'user_orders.agent_id', '=', 'B.id')
            ->select(
                'A.name as user_name',
                'A.email as user_email',
                'B.name as agent_name',
                'products.product_name',
                'user_orders.weight',
                'user_orders.amount'
            )
            ->where('user_orders.oid', $request->oid)
            ->first();

        Mail::to($orderDetails->user_email)->send(new orderComplete(
            $orderDetails->user_name,
            $orderDetails->agent_name,
            $orderDetails->weight,
            $orderDetails->amount,
            $orderDetails->product_name
        ));

        return redirect('/agent_order_list')->with('success', 'Order updated successfully');
        // return back()->with('success', 'Order updated successfully');
    }
}
