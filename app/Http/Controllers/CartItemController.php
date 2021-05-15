<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        // 1. 建立 $validator, 如果發生錯誤就 response error
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ], $msgs);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        // 3. 可以驗證資料格式是否正確
        // $validateData = $validator->validate();
        // $form = $request->all();
        // DB::table('cart_items')->insert(
        //     [
        //         "cart_id" => $validateData['cart_id'],
        //         "product_id" => $validateData['product_id'],
        //         "quantity" => $validateData['quantity'],
        //         "created_at" => now(),
        //         "updated_at" => now()
        //     ]
        // );


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
    
        /*
            [新增] 重點
            1.你取 Table 的 ORM 技巧
            2. insert && request   

            [新增技巧] insertGetId
            利用以下方式可以得到:你新增的檔案的 流水號id
            $id =  DB::table('cart_items')->insertGetId([...])

            [新增技巧] increment

            DB::table('cart_items')
            ->where('id', '2')
            ->increment('quantity', 2);

            針對欄位，可以增加值。
            如果不寫後面的數值，預設是增加 1
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
    public function update(Request $request, $id)
    {
        //
        $form = $request->all();
        /*
        [重點] 找出你要更新的那筆資料
            其次才是使用 update function
        */ 
        
        // 用 postman 測試！！
        DB::table('cart_items')->where('id', $id)->update(
            [
                "quantity" => $form['quantity'],
                "updated_at" => now()
            ]
        );
        return response()->json(true);
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
