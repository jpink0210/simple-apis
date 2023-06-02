<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*
        產生這支檔案
        pa make:seeder ProductSeeder
        執行方式：
        pa db:seed --class=ProductSeeder
        upsert = update + insert 沒有就加，有就改
        2nd Key: 憑藉的 key, 搜尋對象
        3rd Key: 會修改的對象
    */
    public function run()
    {
        Product::upsert([
            ['id' => 1, 'title' => '固定資料', 'content' => '固定內容', 'price' => 300, 'quantity' => 20],
            ['id' => 2, 'title' => '固定資料2', 'content' => '固定內容2', 'price' => 500, 'quantity' => 20],
        ], ['id'], ['price', 'quantity']);
    }
}
