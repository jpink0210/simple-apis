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
            [
                'id' => 1,
                'title' => '衣索比亞 耶加雪菲 G1 水洗 咖啡豆',
                'content' => '風味：橘皮精油， 白花，桃子',
                'price' => 300,
                'quantity' => 400
            ],
            [
                'id' => 2,
                'title' => '衣索比亞 耶加雪菲 G1 日曬 咖啡豆',
                'content' => '風味｜澄花、茉莉、水果軟糖、柑橘',
                'price' => 350,
                'quantity' => 250
            ],
            [
                'id' => 3,
                'title' => '瓜地馬拉 拉米尼塔 花神 咖啡豆',
                'content' => '風味敘述：花香主體風味，巧克力般的餘韻，焦糖甜感強，乾淨、明亮、酸值飽滿。',
                'price' => 350,
                'quantity' => 200
            ],
            [
                'id' => 4,
                'title' => '烏干達 布吉蘇 AA 咖啡豆',
                'content' => '風味｜辛香料、奶油、焦糖、巧克力',
                'price' => 450,
                'quantity' => 330
            ],
            [
                'id' => 5,
                'title' => '印尼 曼特寧 精選G1 一磅裝 咖啡豆',
                'content' => '風味敘述：藥草、焦糖甜、杉木、口感厚實',
                'price' => 400,
                'quantity' => 100
            ],
            [
                'id' => 6,
                'title' => '巴西 摩吉安娜產區 COE 冠軍莊園 皇后莊園 100% 黃波旁 咖啡豆',
                'content' => '風味敘述：研磨乾香有明顯核桃、開心果，以及細膩的莓果香甜感。典型巴西的核桃風味，巧克力的香甜餘韻。',
                'price' => 450,
                'quantity' => 50
            ],
            [
                'id' => 7,
                'title' => '哥倫比亞 精選 咖啡豆 一磅裝 超值優惠活動 優惠價回饋 咖啡豆',
                'content' => '風味敘述：堅果、甜感佳、乾淨度高、李子酸香',
                'price' => 330,
                'quantity' => 200
            ],
            [
                'id' => 8,
                'title' => '薩爾瓦多 APANECA-ILAMATEPEC 山脈 藍絲帶莊園 蜜處理 咖啡豆',
                'content' => '風味｜百香蜜、迷迭香、甜橙',
                'price' => 290,
                'quantity' => 700
            ],
            [
                'id' => 9,
                'title' => '經典曼巴 特調配方 一磅裝｜咖啡豆',
                'content' => '風味敘述：藥草、香甜奶油、苦巧克力韻、濃郁核果、口感滑順扎實、回甘度佳',
                'price' => 200,
                'quantity' => 600
            ],
            [
                'id' => 10,
                'title' => '哥倫比亞 聖圖阿里歐莊園 愛情靈藥 紅波旁 日曬 咖啡豆',
                'content' => '風味｜橙花、蜜桃、芒果果醬、酒釀櫻桃、水果軟糖',
                'price' => 480,
                'quantity' => 400
            ],
        ], ['id'], ['price', 'quantity']);
    }
}
