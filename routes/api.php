<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 這裡的 middleware 就是從 kernal 裡面拿出來用的，可以去找源頭
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
