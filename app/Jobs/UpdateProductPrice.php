<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * https://laravel.com/docs/10.x/queues#generating-job-classes 
 * pa make:job UpdateProductPrice
 *
 *
 * 概觀：
 * 1. 不管是不是用 官方套件，你要有一張 job 表
 *  pa queue:table / pa make:migration [你要儲存job的表]
 *  pa migrate
 *
 * 2. Queue 功能一：塞工作項目到 jobs 代辦任務下方
 *      套件：
 *          pa make:job UpdateProductPrice
 *          dispatch operator -> 執行 官方job 的 「handle func.」
 *
 *      一般： 在 jobs 的表上面，添增數筆
 *
 */

class UpdateProductPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $product;
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     * 這裡是設定 即將要執行的工作內容
     *
     * @return void
     */
    public function handle()
    {
        sleep(5); // 程式暫停五秒的模擬感
        $this->product->update(['price' => $this->product->price * random_int(2, 3)]);
    }
}
