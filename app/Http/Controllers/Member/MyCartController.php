<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\CartItem;

use App\Http\Controllers\CartController;

class MyCartController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        if (!$user) return response("member auth fail.");
        
        $cart = (new CartController)->index();

        $content = json_decode($cart->content());
        $cartId = $content->id;

        /*
            [觀念] Eloquent
            1. blade 只適用 db 的 collection, 不適合萬用的，也許是搭配 vue。但是對後端不重要。
            2. Eloquent with vs DB:table join
            3. all vs get vs first ：總會有一個取值的動作！
        */
        $cartItems = CartItem::with(['product'])->where('cart_id', $cartId)->get();
        /*
            $cartItems = CartItem::all()->where('cart_id', $cartId);

            $cartItems = DB::table('cart_items')->join('products', function($join){
                $join->on('products.id', '=','cart_items.product_id')
                    ->where('products.quantity', '>', '0');
            })->where('cart_id', $cartId)->get();
         */
        $cartItemsC = collect($cartItems);
        $total = 0;
        for ($i=0; $i < count($cartItemsC); $i++) { 
            $total += $cartItemsC[$i]->product->price * $cartItemsC[$i]->quantity;
        };

        return view('member.mycart', [
            'cartId' => $cartId,
            'cartItems' => $cartItems, 
            'total' => $total
        ]);
    }
}
