<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('option_product', function (Blueprint $table) {
            $table->integer('option_id')->unsigned()->index();
            $table->foreign('option_id')
                    ->references('id')
                    ->on('options');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products');

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
        Schema::table('option_product', function(Blueprint $table) {
            $table->dropForeign(['option_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('option_product');
        Schema::dropIfExists('options');
    }
}
