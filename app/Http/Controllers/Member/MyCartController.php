<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class MyCartController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        if (!$user) return;
        $cart_id = 0;
        
        $cart = (new CartController)->index();
        // $cart_id = $cart ? json_decode($cart->content())->id : 0;
        $cartItems = $cart->cartItems();
        dump($cartItems);

        return view('member.mycart', ['cartItems' => $cartItems]);
    }
}
