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
use Illuminate\Support\Facades\Mail;
// use Mail;
use App\Mail\allocationConfirmation;
use App\Mail\orderAllocation;

class AdminProductCtrl extends Controller
{
    public function product_list()
    {
        $products = DB::table('products')
            ->leftJoin('categories', 'products.cid', '=', 'categories.cid')
            ->orderBy('pid', 'desc')
            ->get();

        return view(
            'admin.product-list',
            compact(
                'products',
            )
        );
    }

    public function category_list()
    {
        $products = DB::table('categories')
            ->orderBy('cid', 'desc')
            ->get();

        return view(
            'admin.category-list',
            compact(
                'products',
            )
        );
    }

    public function order_list()
    {
        $data = DB::table('user_orders')
            ->leftJoin('payment_methods', 'user_orders.pmid', '=', 'payment_methods.pmid')
            ->leftJoin('users', 'user_orders.uid', '=', 'users.id')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->select('products.*', 'user_orders.*', 'user_orders.status as user_status', 'users.name', 'payment_methods.payment_type')
            // ->where('user_orders.status', '=', 0)
            // ->where('user_orders.uid', '=', Auth::user()->id)
            ->orderBy('user_orders.oid', 'desc')
            ->get();
        $drivers = DB::table('users')
            ->where('users.status', '=', 1)
            ->where('users.role', '=', 2)
            ->get();

        // dd($drivers);

        return view(
            'admin.order-list',
            compact(
                'data',
                'drivers',
            )
        );
    }

    public function create_product($pid)
    {

        $categories = DB::table('categories')
            ->where('categories.status', '=', 0)
            ->get();
        // dd($categories);

        if ($pid != 0) {
            $products = DB::table('products')
                ->leftJoin('file_manage', 'products.image', '=', 'file_manage.fid')
                ->select('products.*', 'file_manage.file_name')
                ->where('products.pid', '=', $pid)
                ->first();
        } else {
            $products = '';
        }


        return view(
            'admin.create-product',
            compact(
                'products',
                'pid',
                'categories',
            )
        );
    }

    public function create_category($cid)
    {
        if ($cid != 0) {
            $data = DB::table('categories')
                ->leftJoin('file_manage', 'categories.cat_image', '=', 'file_manage.fid')
                ->select('categories.*', 'file_manage.file_name')
                ->where('categories.cid', '=', $cid)
                ->first();
        } else {
            $data = '';
        }


        return view(
            'admin.create-category',
            compact(
                'data',
                'cid',
            )
        );
    }

    public function update_product(Request $request)
    {

        // dd($request->all());
        $logo_fid = 0;
        $logo = '';
        if ($request->pid == 0) {
            if ($request->file('logo_img') != "" && !empty($request->logo)) {
                // dd('here');
                $logo = $request->file('logo_img')->store('products', 's3');
                $logo_name = $request->file('logo_img')->getClientOriginalName();
                $logo_fid = DB::table('file_manage')->insertGetId(
                    array(
                        'file_name' => $logo_name,
                        'type' => 'product',
                        'uri' =>  $logo,
                        'created_on' =>  time(),
                        'status' =>  0,
                    )
                );
            }

            DB::table('products')->insert(
                array(
                    'product_name' => $request->product_name,
                    'product_rate' => $request->product_rate,
                    'description' => $request->description,
                    'cid' => $request->cid,
                    'created_on' => time(),
                    'updated_on' => 0,
                    'image' => $logo_fid,
                    'status' => $request->status == 'on' ? 0 : 1,
                )
            );
        } else {

            if ($request->file('logo_img') != "" && !empty($request->logo)) {
                // dd('here');
                $logo = $request->file('logo_img')->store('products', 's3');
                $logo_name = $request->file('logo_img')->getClientOriginalName();
                $logo_fid = DB::table('file_manage')->insertGetId(
                    array(
                        'file_name' => $logo_name,
                        'type' => 'product',
                        'uri' =>  $logo,
                        'created_on' =>  time(),
                        'status' =>  0,
                    )
                );
            } else if ($request->pid != 0) {
                $company_data = DB::table('products')->where(['pid' => $request->pid])
                    ->leftJoin('file_manage', 'products.image', '=', 'file_manage.fid')
                    ->first();
                $logo_fid = $company_data->fid;
            }


            $table = DB::table('products')
                ->where('pid', $request->pid)
                ->update([
                    'product_name' => $request->product_name,
                    'product_rate' => $request->product_rate,
                    'description' => $request->description,
                    'cid' => $request->cid,
                    'image' => $logo_fid,
                    'updated_on' => time(),
                    'status' => $request->status == 'on' ? 0 : 1,
                ]);
        }

        return redirect('/product_list');
        // return back()->with('success', 'Company created successfully');
    }

    public function update_category(Request $request)
    {
        $logo_fid = 0;
        $logo = '';
        if ($request->cid == 0) {
            if ($request->file('logo_img') != "" && !empty($request->logo)) {
                // dd('here');
                $logo = $request->file('logo_img')->store('category', 's3');
                $logo_name = $request->file('logo_img')->getClientOriginalName();
                $logo_fid = DB::table('file_manage')->insertGetId(
                    array(
                        'file_name' => $logo_name,
                        'type' => 'category',
                        'uri' =>  $logo,
                        'created_on' =>  time(),
                        'status' =>  0,
                    )
                );
            }
            DB::table('categories')->insert(
                array(
                    'category_name' => $request->category_name,
                    'cat_image' => $logo_fid,
                    'created_on' => time(),
                    'status' => $request->status == 'on' ? 0 : 1,
                )
            );
        } else {
            if ($request->file('logo_img') != "" && !empty($request->logo)) {
                // dd('here');
                $logo = $request->file('logo_img')->store('category', 's3');
                $logo_name = $request->file('logo_img')->getClientOriginalName();
                $logo_fid = DB::table('file_manage')->insertGetId(
                    array(
                        'file_name' => $logo_name,
                        'type' => 'category',
                        'uri' =>  $logo,
                        'created_on' =>  time(),
                        'status' =>  0,
                    )
                );
            } else if ($request->cid != 0) {
                $company_data = DB::table('categories')->where(['cid' => $request->cid])
                    ->leftJoin('file_manage', 'categories.cat_image', '=', 'file_manage.fid')
                    ->first();
                $logo_fid = $company_data->fid;
            }


            $table = DB::table('categories')
                ->where('cid', $request->cid)
                ->update([
                    'category_name' => $request->category_name,
                    'cat_image' => $logo_fid,
                    'status' => $request->status == 'on' ? 0 : 1,
                ]);
        }

        return redirect('/category_list');
        // return back()->with('success', 'Company created successfully');
    }

    public function assign_order(Request $request)
    {
        // dd($request->all());
        $table = DB::table('user_orders')
            ->where('oid', $request->oid)
            ->update([
                'agent_id' => $request->uid,
                'status' => 1,
            ]);

        $orderDetails = DB::table('user_orders')
            ->leftJoin('products', 'user_orders.pid', '=', 'products.pid')
            ->leftJoin('users as A', 'user_orders.uid', '=', 'A.id')
            ->leftJoin('users as B', 'user_orders.agent_id', '=', 'B.id')
            ->select(
                'A.name as user_name',
                'A.address as user_address',
                'A.pincode as user_pincode',
                'A.mobile as user_mobile',
                'B.name as agent_name',
                'A.email as user_email',
                'B.email as agent_email',
                'products.product_name'
            )
            ->where('user_orders.oid', $request->oid)
            ->first();

        Mail::to($orderDetails->user_email)->send(new allocationConfirmation($orderDetails->user_name, $orderDetails->agent_name, $orderDetails->product_name));
        Mail::to($orderDetails->agent_email)->send(new orderAllocation(
            $orderDetails->user_name,
            $orderDetails->agent_name,
            $orderDetails->user_address,
            $orderDetails->user_pincode,
            $orderDetails->user_mobile,
            $orderDetails->product_name
        ));

        // return redirect('/category_list');
        return back()->with('success', 'Order assigned successfully');
    }
}
