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

class DriverDashboardCtrl extends Controller
{
    public function driver_dashboard()
    {
        // status 0 = booked
        // 1 = admin assigned order to pickup agent(In Process)
        // 2 = picked up from user
        // 3 = deleted
        $assigned_orders = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            ->where('user_orders.agent_id', '=', Auth::user()->id)
            ->where('user_orders.status', '!=', 3)
            ->orderBy('user_orders.oid', 'desc')
            ->take(3)
            ->get();

        $pending_orders = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            ->where('user_orders.agent_id', '=', Auth::user()->id)
            ->where('user_orders.status', '=', 1)
            ->orderBy('user_orders.oid', 'desc')
            ->take(3)
            ->get();

        $completed_orders = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            ->where('user_orders.agent_id', '=', Auth::user()->id)
            ->where('user_orders.status', '=', 2)
            ->orderBy('user_orders.oid', 'desc')
            ->take(3)
            ->get();

        return view(
            'driver.driver-dashboard',
            compact(
                'assigned_orders',
                'completed_orders',
                'pending_orders',
            )
        );
    }

    public function driver_analytics()
    {
        // status 0 = booked
        // 1 = admin assigned order to pickup agent(In Process)
        // 2 = picked up from user
        // 3 = deleted
        $orders = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            ->where('user_orders.status', '!=', 3)
            ->where('user_orders.agent_id', '=', Auth::user()->id)
            ->orderBy('user_orders.oid', 'desc')
            ->take(3)
            ->get();

        $order_data = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            ->where('user_orders.agent_id', '=', Auth::user()->id)
            ->where('user_orders.status', '!=', 3)
            ->get();

        // dd($order_data);

        $product_count = DB::table('products')
            ->leftJoin('categories', 'categories.cid', '=', 'products.cid')
            ->where('categories.status', '=', 0)
            ->count();

        $categories_count = DB::table('categories')
            ->where('categories.status', '=', 0)
            ->count();

        $order_count = count($order_data);
        $booked_order_count = 0;
        $process_order_count = 0;
        $completed_order_count = 0;
        $amount_collected = 0;
        if (count($order_data) != 0) {
            foreach ($order_data as $key => $val) {
                if ($val->order_status == 0) {
                    $booked_order_count++;
                } else if ($val->order_status == 1) {
                    $process_order_count++;
                } else if ($val->order_status == 2) {
                    $completed_order_count++;
                    $amount_collected = $amount_collected + $val->amount;
                }
            }
        }



        return view(
            'driver.driver-analytics',
            compact(
                'orders',
                'order_count',
                'booked_order_count',
                'process_order_count',
                'completed_order_count',
                'product_count',
                'categories_count',
                'amount_collected',
            )
        );
    }
}
