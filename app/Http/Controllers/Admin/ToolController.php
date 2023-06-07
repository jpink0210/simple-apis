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
        /*
            onQueue:
                官方 queue:table 專用 operator
                這個 table 有預設幫 jobs 做分類，onQueue 就是在塞工作的 設定分類
                如果沒有設定，就是 default

            執行佇列：
                pa queue:work database --queue=default
                pa queue:work database --queue=tool

        */

        foreach ($products as $product) {
            UpdateProductPrice::dispatch($product)->onQueue('tool');
        }
    }

    public function createProductRedis()
    {
        Redis::set(
            'products',
            json_encode(Product::all())
        );
    }
}
/*
安裝本機端的 Redis: 
    brew install redis
啟動redis: 
    redis-server

Laravel 端：

安裝打本機 redis 的 php server:
    composer require predis/predis
    https://laravel.com/docs/10.x/redis#introduction
把這行註解取消：
    'Redis' => Illuminate\Support\Facades\Redis::class,
改 redis 的參數名稱

pa tinker
Redis -> 這行無法，但是下方操作正常
Redis::set('name', 'miles')
Redis::get('name')

提問：

一、redis 實際上快取真正的機制
應該是機器快取，但是所有 api 會導向 快取的機器。

二、那個 moment 執行
實際上的排程要怎麼寫，幾點幾分，如何自動跑？

*/