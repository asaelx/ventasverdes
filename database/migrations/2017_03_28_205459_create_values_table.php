<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('option_id')->unsigned();
            $table->timestamps();

            $table->foreign('option_id')
                    ->references('id')
                    ->on('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('values', function(Blueprint $table) {
            $table->dropForeign(['option_id']);
        });

        Schema::dropIfExists('values');
    }
}
