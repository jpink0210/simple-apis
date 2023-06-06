<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



/**
 * pa queue:table
 * 操作 Queue 的 Model
 * https://laravel.com/docs/10.x/queues#database
 * 
 * 跟 notification 基本上相同，幫官方套件開table, 開通道
 * 
 * .env 設定
 * QUEUE_CONNECTION= sync -> database
 * 告知此 Model 以後跑 q 會用資料庫的模式去做確認
 */
class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
