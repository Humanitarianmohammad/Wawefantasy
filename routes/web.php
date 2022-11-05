<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardCtrl;
use App\Http\Controllers\Admin\AdminDriversCtrl;
use App\Http\Controllers\Admin\AdminProductCtrl;
use App\Http\Controllers\Driver\DriverDashboardCtrl;
use App\Http\Controllers\Driver\DriverOrderCtrl;
use App\Http\Controllers\User\UserDashboardCtrl;
use App\Http\Controllers\User\UserProfileCtrl;
use App\Http\Controllers\User\UserProductCtrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ------------------------Admin URLS START-----------------------------
Route::get('/admin_dashboard', [AdminDashboardCtrl::class, 'admin_dashboard'])
    ->middleware('auth')
    ->name('admin_dashboard');

Route::get('/leaderboard', [AdminDashboardCtrl::class, 'leaderboard'])
    ->middleware('auth')
    ->name('leaderboard');

Route::get('/users_list', [AdminDashboardCtrl::class, 'users_list'])
    ->middleware('auth')
    ->name('users_list');

Route::get('/drivers_list', [AdminDriversCtrl::class, 'drivers_list'])
    ->middleware('auth')
    ->name('drivers_list');

Route::get('/product_list', [AdminProductCtrl::class, 'product_list'])
    ->middleware('auth')
    ->name('product_list');

Route::get('/delete_user/{id}', [AdminDashboardCtrl::class, 'delete_user'])
    ->middleware('auth')
    ->name('delete_user');

Route::get('/approve_user/{id}', [AdminDriversCtrl::class, 'approve_user'])
    ->middleware('auth')
    ->name('approve_user');

Route::get('/create_product/{pid}', [AdminProductCtrl::class, 'create_product'])
    ->middleware('auth')
    ->name('create_product');

Route::post('/update_product', [AdminProductCtrl::class, 'update_product'])
    ->middleware('auth')
    ->name('update_product');

Route::get('/category_list', [AdminProductCtrl::class, 'category_list'])
    ->middleware('auth')
    ->name('category_list');

Route::get('/order_list', [AdminProductCtrl::class, 'order_list'])
    ->middleware('auth')
    ->name('order_list');

Route::get('/create_category/{cid}', [AdminProductCtrl::class, 'create_category'])
    ->middleware('auth')
    ->name('create_category');

Route::post('/assign_order', [AdminProductCtrl::class, 'assign_order'])
    ->middleware('auth')
    ->name('assign_order');

Route::post('/update_category', [AdminProductCtrl::class, 'update_category'])
    ->middleware('auth')
    ->name('update_category');

Route::post('/leaderboard_filter', [AdminDashboardCtrl::class, 'leaderboard_filter'])
    ->middleware('auth')
    ->name('leaderboard_filter');
// ------------------------Admin URLS END-----------------------------

// ------------------------Driver URLS START-----------------------------
Route::get('/driver_dashboard', [DriverDashboardCtrl::class, 'driver_dashboard'])
    ->middleware('auth')
    ->name('driver_dashboard');

Route::get('/agent_order_list', [DriverOrderCtrl::class, 'agent_order_list'])
    ->middleware('auth')
    ->name('agent_order_list');

Route::post('/confirm_pickup', [DriverOrderCtrl::class, 'confirm_pickup'])
    ->middleware('auth')
    ->name('confirm_pickup');

Route::get('/accept_order/{oid}', [DriverOrderCtrl::class, 'accept_order'])
    ->middleware('auth')
    ->name('accept_order');

Route::get('/driver_analytics', [DriverDashboardCtrl::class, 'driver_analytics'])
    ->middleware('auth')
    ->name('driver_analytics');

Route::get('/pending_driver', function () {
    return view('driver.pending-driver');
})->middleware(['auth'])->name('pending_driver');

Route::get('/register_driver', function () {
    return view('driver.register-driver');
})->middleware(['auth'])->name('register_driver');
// ------------------------Driver URLS END-----------------------------

// ------------------------User URLS START-----------------------------
Route::get('/user_dashboard', [UserDashboardCtrl::class, 'user_dashboard'])
    ->middleware('auth')
    ->name('user_dashboard');

Route::get('/user_analytics', [UserDashboardCtrl::class, 'user_analytics'])
    ->middleware('auth')
    ->name('user_analytics');

Route::get('/user_profile', [UserProfileCtrl::class, 'user_profile'])
    ->middleware('auth')
    ->name('user_profile');

Route::post('/verify_user_mail', [UserProfileCtrl::class, 'verify_user_mail'])
    ->middleware('auth')
    ->name('verify_user_mail');

Route::post('/create_order', [UserProductCtrl::class, 'create_order'])
    ->middleware('auth')
    ->name('create_order');

Route::get('/user_product_list/{cid}', [UserProductCtrl::class, 'user_product_list'])
    ->middleware('auth')
    ->name('user_product_list');

Route::get('/user_category_list', [UserProductCtrl::class, 'user_category_list'])
    ->middleware('auth')
    ->name('user_category_list');

Route::get('/user_order_list', [UserProductCtrl::class, 'user_order_list'])
    ->middleware('auth')
    ->name('user_order_list');

Route::get('/user_order_page/{pid}', [UserProductCtrl::class, 'user_order_page'])
    ->middleware('auth')
    ->name('user_order_page');

Route::post('sendEmailOtp', [UserProfileCtrl::class, 'sendEmailOtp'])
    ->middleware('auth')
    ->name('sendEmailOtp');

Route::post('verifyEmailOtp', [UserProfileCtrl::class, 'verifyEmailOtp'])
    ->middleware('auth')
    ->name('verifyEmailOtp');
// ------------------------User URLS END-----------------------------

require __DIR__ . '/auth.php';
