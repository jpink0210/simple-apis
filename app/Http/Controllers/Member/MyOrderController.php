<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
/**
 * pa make:controller Member/MyOrderController
 */
class MyOrderController extends Controller
{
    //
    public function index()
    {

        $user = auth()->user();
        if (!$user) return response("member auth fail.");

        $orders = $user->orders()->with(['orderItems.product', 'orderItems'])->orderBy("updated_at", "desc")->get();
        return view('member.myorder', ['orders' => $orders,]);
    }
}
