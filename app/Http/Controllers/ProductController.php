<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Services\ShortUrlService;

class ProductController extends Controller
{
    protected $shortUrlService;
    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        /*
            顯示技巧
            1. db table
            $products = DB::table('products')->get();
            [DB Table]  ([Model Table] / 都是 Laravel ORM)

            2 [Select] 限制欄位  
            select 可以限制你要的欄位, addSelect 可以補加欄位     
            $products = DB::table('products')->select('price')->addSelect('quantity')->get();
    
            3. [Where] 就是條件篩選
            a. 一般是用指定
            b. 或是不等式
            c. whereRaw 就是 sql 語法
            $products = DB::table('products')->whereRaw('price > 300')->get();
    
            6. [Debug SQL] 
            用這個方式可以 印出 DB:: 的 sql 語法，來 debug
            $products = DB::table('products')->where('id', 1)->dd();
            $products = DB::table('products')->where('id', 1)->dump();
        */ 

        // $products = json_decode(Redis::get('products'));
        $products = DB::table('products')->select('price')->addSelect('quantity')->get();

        return response($products);
        // return response()->json($products);

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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function sharedUrl($id)
    {
        // 假設有查看特定使用者分享次數的邏輯
        // eg: auth()->user()->checkShareCount...
        // $this->authService->fakeReturn(); ( 後面才上到，先註解 )
        $url = $this->shortUrlService->makeSortUrl("http://localhost:3000/products/$id");
        return response(['url' => $url]);
    }
}
