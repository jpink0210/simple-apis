<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// 自己客製化的 request機制
use App\Http\Requests\UpdateCartItem;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            4. [Join]
            
            思考 join table 誰，id 對應 foreign id。
            $cart_items = DB::table('cart_items')
                        ->join('products', 'products.id', '=','cart_items.product_id')
                        ->select('*')
                        ->get();

            包含 leftJoin, rightJoin，join 只是 innerJoin

            5. [Join] 加上篩選條件
                等於先篩選完之後，才join進去
        */ 
        
        $cart_items = DB::table('cart_items')
            ->join('products', function($join){
            $join->on('products.id', '=','cart_items.product_id')
                ->where('products.quantity', '>', '0');
        })
        ->select('*') // 沒有這行也無所謂
        //  ->select('title') 可以在這行，去選你要的 Col Name, -> 這個  title 是join 的表裡面的。
        //  即便是已經 join 完之後，你要「視為同一張表」來思考其可以
         ->get();
        return response($cart_items);
        
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

        // https://laravel.tw/docs/5.0/validation#available-validation-rules

        // 2. 可以設定中文回覆訊息，加到 Validator 第三個變數。
        $msgs = [
            "required" => ":attribute 是必要的",
            "between" => ":attribute 的輸入請介於 :min ~ :max 之間"
        ];

        /*
        1. 建立 $validator
            Validator 這個 facade 只是拿 $request 建立一個有驗證特性的物件。
            驗證後，如果發生錯誤就 response error by ->fails()
            ->validate(); 這個動作才是把物件轉換成 資料庫可以使用的 資料格式。

        */
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ], $msgs);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $validatedData = $validator->validate();

        $product = Product::find($validatedData['product_id']);
        /*
            商務邏輯
        */
        if (!$product->checkQuantity($validatedData['quantity'])) {
            return response($product->title.'數量不足', 400);
        }

        $cart = Cart::find($validatedData['cart_id']);
        $result = $cart->cartItems()->create(
            ['product_id' => $product->id,
             'quantity' => $validatedData['quantity']]
        );

        return response()->json($result);

        /*
        3. 可以驗證資料格式是否正確:
            $validateData = $validator->validate();
            $form = $request->all();
            DB::table('cart_items')->insert(
                [
                    "cart_id" => $validateData['cart_id'],
                    "product_id" => $validateData['product_id'],
                    "quantity" => $validateData['quantity'],
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            );
        */

        /*
          POST: http://127.0.0.1:8000/cart-items?cart_id=&quantity=14&product_id=2
          resp:
            {
                "cart_id": [
                    "cart id 是必要的"
                ],
                "quantity": [
                    "quantity 的輸入請介於 1 ~ 10 之間"
                ]
            }
        */

        /*
            // 用 postman 測試！！
            $form = $request->all();
            DB::table('cart_items')->insert(
                [
                    "cart_id" => $form['cart_id'],
                    "product_id" => $form['product_id'],
                    "quantity" => $form['quantity'],
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            );
            return response()->json(true); // 用 json 才是前端常看到的值
        */

        /*
          這裡是原版
          先是講解 Eloquent 關聯，用於 Controller 實作的改變
          1. [觀念] 這裡是新增 cartItems, 必然是以 cartItems 為主體
          2. $cart->cartItems() 這裡用的就是關聯, cartItems belongsTo Cart
          3. ->cartItems() 使用這個括弧，本身就代表 cartItems 為主體
          4. 只不過，這裡隸屬於 Cart 之下的「主體」，好處就是你不用再帶 cartId
          5. 相較於 DB:insert 不用時間戳，也是因為 Model 有 timestamps
        */
        // $form = $request->all();
        // $cart = Cart::find($form['cart_id']);
        // $result = $cart->cartItems()->create(
        //     [
        //         "product_id" => $form['product_id'],
        //         "quantity" => $form['quantity']
        //     ]
        // );
        // return response()->json($result);


        /*
            [新增] 重點
            1.你取 Table 的 ORM 技巧
            2. insert && request   

            [新增技巧] insertGetId
            利用以下方式可以得到:你新增的檔案的 !!「流水號id」!!
            $id =  DB::table('cart_items')->insertGetId([...])

            [新增技巧] increment 直接針對 某個欄位 增加值，就不用用覆寫。

            DB::table('cart_items')
            ->where('id', '2')
            ->increment('quantity', 2);

            針對欄位，可以增加值。
            如果不寫後面的數值，預設是增加 1

            dd, dump, enableQueryLog: debug 工具
        */
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
    public function update(UpdateCartItem $request, $id)
    {
        /*
        Validators 進階使用 [三]
            UpdateCartItem $request 這裡是灌入的關鍵
            $request->validated(), 這裡與上面比對，這是 validator 特有的函式
            不是 $request 的。
            fill: 先填在物件上，但是不會存入資料庫，因為你中間可能要改來改去。
            save: 最後才真的存入「資料庫」。
        */
        $validatedData = $request->validated();
        $item = CartItem::find($id);
        $item->fill(['quantity' => $validatedData['quantity']]);
        // do something
        $item->save();

        return response()->json(true);
        /*
            postman
            http://127.0.0.1:8000/cart-items/2?id=1&quantity=1
            改成
            http://127.0.0.1:8000/cart-items/1?quantity=6
        */


        /* 以下舊版 Query Builder */
        /*
        [重點]
            1. update()
            2. PUT 使用前要找出那筆資料
        */
        // $form = $request->all();
        // DB::table('cart_items')->where('id', $id)->update(
        //     [
        //         "quantity" => $form['quantity'],
        //         "updated_at" => now()
        //     ]
        // );
        // return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        [重點]
            1. 不用 req
            2. 找目標用 where
            3. delete function
        */
        // 用 postman 測試！！
        DB::table('cart_items')->where('id', $id)->delete();
        return response()->json(true);
    }
}
