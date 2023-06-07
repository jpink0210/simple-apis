<?php

use Illuminate\Support\Facades\Route;

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


Route::resource('column', 'ColumnController');
Route::resource('today', 'TodayController');
Route::resource('product', 'ProductController');



Route::get('/', 'WebController@index');
Route::get('/contactUs', 'WebController@contactUs');
Route::post('/readNotification', 'WebController@readNotification');


// Auth Login
Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');

Route::group(
    [
    'middleware' => 'auth:api'
],
    function () {
        Route::get('user', 'AuthController@user');
        Route::get('logout', 'AuthController@logout');

        Route::resource('cart', 'CartController');
        Route::resource('cart-items', 'CartItemController');

        Route::post('carts/checkout', 'CartController@checkout');
    }
);

Route::post('admin/orders/{id}/delivery', 'Admin\OrderController@delivery');
Route::resource('admin/orders', 'Admin\OrderController');

Route::post('admin/tools/updateProductPrice', 'Admin\ToolController@updateProductPrice');

/*
就排程上來說，你一定有某個 moment 反覆去執行這個。
*/
Route::post('admin/tools/createProductRedis', 'Admin\ToolController@createProductRedis');

Route::get('products/{id}/sharedUrl', 'ProductController@sharedUrl');
