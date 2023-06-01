<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
    pa make:migration add_quantity_to_cart_items
    就會直接附帶：
        Schema::table
        cart_items
    你自己補上你要上的 key
*/

class AddQuantityToCartItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // 以下是你要的 key
            $table->integer('quantity')->after('cart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // dropColumn： 刪除掉某個欄位
            $table->dropColumn('quantity');
        });
    }
}
