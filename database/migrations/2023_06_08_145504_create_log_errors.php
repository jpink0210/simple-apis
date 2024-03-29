<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_errors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0);
            $table->text('exception')->nullable();
            $table->text('message')->nullable();
            $table->integer('line')->nullable();
            $table->json('trace')->nullable()->comment("多層檔案的追蹤，看源頭，json結構");

            $table->string('method', 16)->nullable()->comment("get or post or ...");
            $table->json('params')->nullable();
            $table->text('uri')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('header')->nullable();
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
        Schema::dropIfExists('log_errors');
    }
}
