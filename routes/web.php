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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'WebController@index')->name('home');
Route::get('/contactUs', 'WebController@contactUs')->name('contactUs');

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
Route::get('admin/products', 'Admin\ProductController@index')->name('admin-products');
Route::get('admin/orders', 'Admin\OrderController@index')->name('admin-orders');

Route::resource('admin/products', 'Admin\ProductController');
Route::post('admin/orders/{id}/delivery', 'Admin\OrderController@delivery');
Route::resource('admin/orders', 'Admin\OrderController');


Route::post('admin/tools/updateProductPrice', 'Admin\ToolController@updateProductPrice');
Route::post('admin/products/uploadImage', 'Admin\ProductController@uploadImage');

/*
就排程上來說，你一定有某個 moment 反覆去執行這個。
*/
Route::post('admin/tools/createProductRedis', 'Admin\ToolController@createProductRedis');

Route::get('products/{id}/sharedUrl', 'ProductController@sharedUrl');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';