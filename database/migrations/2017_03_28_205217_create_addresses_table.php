<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mienvio_object_id')->unsigned()->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('zipcode');
            $table->integer('profile_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign(['profile_id']);
        });

        Schema::dropIfExists('addresses');
    }
}
