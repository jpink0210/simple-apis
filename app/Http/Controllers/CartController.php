<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            $cart = DB::table('carts')->get()->first();
            if (empty($cart)) {
                DB::table('carts')->insert(
                    [
                        "created_at" => now(),
                        "updated_at" => now()
                    ]
                    );
                $cart = DB::table('carts')->get()->first();
            }
            // dump($cart);

            $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();

            // 然後重新組裝一下, 原本拿到是一個結構特殊的 object, 要轉換成 collection
            $cart = collect($cart);
            $cart['items'] = collect($cartItems);
            // 資料庫的東西，Facades\DB 取出來通常會看不懂，所以要加上 collect
            return response($cart);
        */
        /*
            1. Eloquent 改寫
            2. :: 是所有 ORM 取出來的資料物件的操作
            3. where: 如果沒有找到有此userId, 就藉此產生之 first vs firstOrCreate
        */
        $user = auth()->user();
        $cart = Cart::with('cartItems')->where('user_id', $user->id)
        ->where('checkouted', false)
        ->firstOrCreate(['user_id' => $user->id]);
        
        return response($cart);
    }

    /*
        商務邏輯
    */
    public function checkout()
    {
        $user = auth()->user();
        /*
            1. $user->carts() user 要招喚 carts() 有個前提是
                UserModel 下面要有 Carts Func 也就是關聯，這邊是 hasMany 才能操作 Cart Model
            2. with('cartItems') 是 Cart Model 的能耐，操作的前提，與上同理。
                所以以後寫扣有報錯，你就要去看 ORM 你的 Model 關聯有沒有搞好。
                也可解讀成：先寫好關聯，是為了 Controller 好操作 Eloquent Function
            3. where 是條件，搜出一打，要 first()
            4. $cart->checkout(); 操作的是 Cart Model 就非常合理了
        */
        $cart = $user->carts()->where('checkouted', false)->with('cartItems')->first();
        if ($cart) {
            $result = $cart->checkout();
            return response(['result' => $result]);
        } else {
            return response('empty cart', 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
