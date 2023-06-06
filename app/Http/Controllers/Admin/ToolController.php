<?php

/*
記得設定 namespace
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateProductPrice;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;

class ToolController extends Controller
{
    public function updateProductPrice()
    {
        $products = Product::all();
        /*
            dispatch: 
                等同於執行 Jobs 的 handle function,
                把你想要的 job 灌入 job table(類似於代辦清單中)
            postman:
                http://127.0.0.1:8000/admin/tools/updateProductPrice

        */
        foreach ($products as $product) {
            UpdateProductPrice::dispatch($product);
        }
    }
}
