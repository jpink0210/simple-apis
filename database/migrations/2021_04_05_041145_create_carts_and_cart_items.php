<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateCartsAndCartItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('carts_and_cart_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(User::class);
            // https://laravel.com/docs/10.x/migrations#column-method-foreignIdFor
            // $table->boolean('bought')->nullable()->default(false)->comment('買了沒');
            $table->timestamps();
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreignId('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('carts_and_cart_items');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_items');
    }
}
