<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('footer');
            $table->integer('favicon_id')->unsigned()->nullable();
            $table->integer('logo_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('favicon_id')
                    ->references('id')
                    ->on('medias');

            $table->foreign('logo_id')
                    ->references('id')
                    ->on('medias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function(Blueprint $table) {
            $table->dropForeign(['favicon_id']);
            $table->dropForeign(['logo_id']);
        });

        Schema::dropIfExists('settings');
    }
}
