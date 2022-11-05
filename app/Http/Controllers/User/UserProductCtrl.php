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
use App\Mail\SellingConfirmation;

class UserProductCtrl extends Controller
{
    public function user_product_list($cid)
    {
        if ($cid == 0) {
            $categories = DB::table('categories')
                ->leftJoin('products', 'categories.cid', '=', 'products.cid')
                ->where('categories.status', '=', 0)
                ->get()->groupBy('cid');

            $products = DB::table('products')
                ->leftJoin('categories', 'categories.cid', '=', 'products.cid')
                ->where('categories.status', '=', 0)
                ->get();
        } else {
            $categories = DB::table('categories')
                ->leftJoin('products', 'categories.cid', '=', 'products.cid')
                ->where('categories.cid', '=', $cid)
                ->where('categories.status', '=', 0)
                ->get()->groupBy('cid');

            $products = DB::table('products')
                ->leftJoin('categories', 'categories.cid', '=', 'products.cid')
                ->where('categories.cid', '=', $cid)
                ->where('categories.status', '=', 0)
                ->get();
        }


        return view(
            'user.user-product-list',
            compact(
                'products',
                'categories',
            )
        );
    }

    public function user_category_list()
    {
        $categories = DB::table('categories')
            ->where('categories.status', '=', 0)
            ->get();

        return view(
            'user.user-category-list',
            compact(
                'categories',
            )
        );
    }

    public function user_order_list()
    {
        $data = DB::table('user_orders')
            ->leftJoin('payment_methods', 'user_orders.pmid', '=', 'payment_methods.pmid')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.status as user_status', 'payment_methods.payment_type')
            // ->where('user_orders.status', '=', 0)
            ->where('user_orders.uid', '=', Auth::user()->id)
            ->orderBy('user_orders.oid', 'desc')
            ->get();

        // dd($data);
        return view(
            'user.user-orders-list',
            compact(
                'data',
            )
        );
    }

    public function user_order_page($pid)
    {
        $data = DB::table('products')
            ->where('products.pid', '=', $pid)
            ->where('products.status', '=', 0)
            ->first();

        return view(
            'user.user-order',
            compact(
                'data',
            )
        );
    }

    public function create_order(Request $request)
    {
        // dd($request);
        DB::table('user_orders')->insert(
            array(
                'pid' => $request->pid,
                'weight' => $request->final_weight,
                'rate' => $request->rate,
                'amount' => $request->amount,
                'uid' => Auth::user()->id,
                'created_on' => time(),
                'picked_on' => 0,
                'status' => 0,
            )
        );

        $data = DB::table('products')
            ->where('products.pid', '=', $request->pid)
            ->first();

        $user_data = DB::table('users')
            ->where('users.id', '=', Auth::user()->id)
            ->select('users.email')
            ->first();

        if (!empty($user_data->email)) {
            Mail::to($user_data->email)->send(new SellingConfirmation(Auth::user()->name, Auth::user()->id, $data->product_name));
        }

        return redirect('/user_dashboard')->with('success', 'Order updated successfully');
        // return back()->with('success', 'Order updated successfully');
    }
}
