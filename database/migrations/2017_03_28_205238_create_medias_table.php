<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('original_name');
            $table->string('url');
            $table->enum('type', [
                'image',
                'audio',
                'video',
                'document',
                'youtube'
            ]);
            $table->timestamps();
        });

        Schema::create('media_product', function(Blueprint $table) {
            $table->integer('media_id')->unsigned()->index();
            $table->foreign('media_id')
                    ->references('id')
                    ->on('medias');

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
        Schema::table('media_product', function(Blueprint $table) {
            $table->dropForeign(['media_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('media_product');
        Schema::dropIfExists('medias');
    }
}
