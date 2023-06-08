<?php

namespace App\Http\Services;

use Exception;
// 把 laravel 轉成 一個 client 可以去打人的 api
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShortUrlService implements ShortUrlInterfaceService
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public $version = 2.5;

    public function makeSortUrl($url)
    {
        /**
         * https://picsee.io/
         * 皮克看見 縮網址
        */
        try {
            // 測試用，一小時就失效
            $accessToken = '20f07f91f3303b2f66ab6f61698d977d69b83d64';
            // 正常來說 token 要放在 .env 裡面，這裡是測試可忽略
            // $accessToken = env("URL_ACCESS_TOKEN");
            // 依照官方文件建立 post 格式
            $data = [
                'url' => $url,
            ];
            $postData = [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode($data)
            ];

            // 1st: 自命名前綴詞 , Log 會傳到 logs 的資料夾
            Log::info('postData', ['data' => $postData]);
            
            $response = $this->client->request(
                'POST',
                'https://api.pics.ee/v1/links/?access_token='.$accessToken,
                $postData
            );
            $contents = $response->getBody()->getContents();
            Log::channel('url_shorten')->info('responseData', ['data' => $contents]);
            $contents = json_decode($contents);
            $url = $contents->data->picseeUrl;
        } catch (\Throwable $e) {
            report($e);
            return $url;
        }
        return $url;
    }
}
