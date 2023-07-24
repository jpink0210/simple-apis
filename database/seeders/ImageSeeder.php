<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*
        執行方式：
        pa db:seed --class=ImageSeeder
        upsert = update + insert 沒有就加，有就改
    */
    public function run()
    {
        Image::upsert([
            [
                'id' => 1,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 1,
                'filename' => '衣索比亞 耶加雪菲 G1 水洗 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/7953885980fc19bb786c67fbb1281de8'
            ],
            [
                'id' => 2,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 2,
                'filename' => '衣索比亞 耶加雪菲 G1 日曬 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/c0d887c705b33f0fadd8a4baaa94198c'
            ],
            [
                'id' => 3,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 3,
                'filename' => '瓜地馬拉 拉米尼塔 花神 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/19e3010dff721727b61a9bab8d0ab2df'
            ],
            [
                'id' => 4,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 4,
                'filename' => '烏干達 布吉蘇 AA 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/tw-11134207-7qul3-li8yquv1salw79'
            ],
            [
                'id' => 5,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 5,
                'filename' => '印尼 曼特寧 精選G1 一磅裝 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/05f13bd3dbf5a8453fb0dcb06ba53c60'
            ],
            [
                'id' => 6,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 6,
                'filename' => '巴西 摩吉安娜產區 COE 冠軍莊園 皇后莊園 100% 黃波旁 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/cc327013617b8f283289d5699dd764eb'
            ],
            [
                'id' => 7,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 7,
                'filename' => '哥倫比亞 精選 咖啡豆 一磅裝 超值優惠活動 優惠價回饋 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/bd47331ad8ffcf1e72a7b2ba914afdea'
            ],
            [
                'id' => 8,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 8,
                'filename' => '薩爾瓦多 APANECA-ILAMATEPEC 山脈 藍絲帶莊園 蜜處理 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/tw-11134207-7qul5-lhiet0etn93i77'
            ],
            [
                'id' => 9,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 9,
                'filename' => '經典曼巴 特調配方 一磅裝｜咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/3d36f12ea0f881cea7ed9c748eeace9b'
            ],
            [
                'id' => 10,
                'attachable_type' => 'App\Models\Product',
                'attachable_id' => 10,
                'filename' => '哥倫比亞 聖圖阿里歐莊園 愛情靈藥 紅波旁 日曬 咖啡豆',
                'path' => 'https://down-tw.img.susercontent.com/file/tw-11134207-7qul7-lhiet0etvoi656'
            ],
        ], ['id']);
    }
}
