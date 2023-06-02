<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
    pa make:migration add_user_id_to_carts
    pa migrate
    補充： 剛開始，因為原本沒有值，所以 migrate 之後
    預設 cart 新增的  userId 是 0 要自己調整一下，我是去 db 改
*/

class AddUserIdToCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
