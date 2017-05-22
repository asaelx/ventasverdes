<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->unsigned();
            $table->integer('variation_id')->unsigned();
            $table->integer('cart_id')->unsigned();
            $table->timestamps();

            $table->foreign('variation_id')
                    ->references('id')
                    ->on('variations');

            $table->foreign('cart_id')
                    ->references('id')
                    ->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quantities', function(Blueprint $table) {
            $table->dropForeign(['variation_id']);
            $table->dropForeign(['cart_id']);
        });

        Schema::dropIfExists('quantities');
    }
}
