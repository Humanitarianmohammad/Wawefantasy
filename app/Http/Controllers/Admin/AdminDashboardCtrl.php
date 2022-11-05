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

class AdminDashboardCtrl extends Controller
{
    public function admin_dashboard()
    {
        // status 0 = booked
        // 1 = admin assigned order to pickup agent(In Process)
        // 2 = picked up from user
        // 3 = deleted
        $orders = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            ->where('user_orders.status', '!=', 3)
            ->orderBy('user_orders.oid', 'desc')
            ->take(3)
            ->get();

        $order_data = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.created_on as order_date', 'user_orders.status as order_status')
            // ->where('user_orders.uid', '=', Auth::user()->id)
            ->where('user_orders.status', '!=', 3)
            ->get();

        $product_count = DB::table('products')
            ->leftJoin('categories', 'categories.cid', '=', 'products.cid')
            ->where('products.status', '=', 0)
            ->where('categories.status', '=', 0)
            ->count();

        $categories_count = DB::table('categories')
            ->where('categories.status', '=', 0)
            ->count();

        $order_count = count($order_data);
        $booked_order_count = 0;
        $process_order_count = 0;
        $completed_order_count = 0;
        if (count($order_data) != 0) {
            foreach ($order_data as $key => $val) {
                if ($val->order_status == 0) {
                    $booked_order_count++;
                } else if ($val->order_status == 1) {
                    $process_order_count++;
                } else if ($val->order_status == 2) {
                    $completed_order_count++;
                }
            }
        }

        return view(
            'Admin.admin-dashboard',
            compact(
                'orders',
                'order_count',
                'booked_order_count',
                'process_order_count',
                'completed_order_count',
                'product_count',
                'categories_count',
            )
        );
    }

    public function leaderboard()
    {
        $orders = DB::table('user_orders')
            ->leftJoin('users', 'user_orders.uid', '=', 'users.id')
            ->where('user_orders.status', '=', 2)
            // ->where('user_orders.uid', '=', Auth::user()->id)
            ->orderBy('user_orders.oid', 'desc')
            ->get();

        // dd($orders);

        $users = [];
        $users_data = [];

        if (count($orders) != 0) {
            foreach ($orders as $key => $val) {
                $amt = intval($val->amount); // converting to int to remove decimals
                if (!array_key_exists($val->id, $users_data)) {
                    $users_data[$val->id]['total_val'] = $amt;
                    $users_data[$val->id]['data'] = $val;
                } else {
                    $users_data[$val->id]['total_val'] = $users_data[$val->id]['total_val'] + $amt;
                }
            }
            uasort($users_data, array($this, 'element_sort'));
            foreach ($users_data as $key => $val) {
                array_push($users, $val);
            }
        }
        // dd($users);


        return view(
            'admin.leaderboard',
            compact(
                'users',
            )
        );
    }

    public function leaderboard_filter(Request $request)
    {
        $from = str_replace('/', '-', $request->from);
        $fromconvertedDate = date("m/d/Y", strtotime($from));
        $start_date = strtotime($fromconvertedDate);

        $to = str_replace('/', '-', $request->to);
        $toconvertedDate = date("m/d/Y", strtotime($to));
        $end_date = strtotime($toconvertedDate);

        $orders = DB::table('user_orders')
            ->leftJoin('users', 'user_orders.uid', '=', 'users.id')
            ->where('user_orders.status', '=', 2)
            ->whereBetween('user_orders.picked_on', [$start_date, $end_date])
            ->orderBy('user_orders.oid', 'desc')
            ->get();

        $users = [];
        $users_data = [];

        if (count($orders) != 0) {
            foreach ($orders as $key => $val) {
                $amt = intval($val->amount); // converting to int to remove decimals
                if (!array_key_exists($val->id, $users_data)) {
                    $users_data[$val->id]['total_val'] = $amt;
                    $users_data[$val->id]['data'] = $val;
                } else {
                    $users_data[$val->id]['total_val'] = $users_data[$val->id]['total_val'] + $amt;
                }
            }
            uasort($users_data, array($this, 'element_sort'));
            foreach ($users_data as $key => $val) {
                array_push($users, $val);
            }
        }

        return json_encode($users);
    }

    private static function element_sort($a, $b)
    {
        //  dd($a['total_val']);
        if ($a['total_val'] == $b['total_val']) {
            return 0;
        }

        return ($a['total_val'] < $b['total_val']) ? 1 : -1;
    }

    public function users_list()
    {
        $users = DB::table('users')
            ->where('users.role', '=', 3)
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.users-list',
            compact(
                'users',
            )
        );
    }

    public function delete_user($id)
    {
        $table = DB::table('users')
            ->where('id', $id)
            ->update([
                'status' => 2,
            ]);

        // return redirect('/vendor_list');
        return back()->with('success', 'User deleted successfully');
    }
}
