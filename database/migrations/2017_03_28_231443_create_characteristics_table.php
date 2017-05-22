<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->integer('icon_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('icon_id')
                    ->references('id')
                    ->on('medias');
        });

        Schema::create('characteristic_product', function(Blueprint $table) {
            $table->integer('characteristic_id')->unsigned()->index();
            $table->foreign('characteristic_id')
                    ->references('id')
                    ->on('characteristics');

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
        Schema::table('characteristics', function(Blueprint $table) {
            $table->dropForeign(['icon_id']);
        });

        Schema::table('characteristic_product', function(Blueprint $table) {
            $table->dropForeign(['characteristic_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('characteristic_product');
        Schema::dropIfExists('characteristics');
    }
}
