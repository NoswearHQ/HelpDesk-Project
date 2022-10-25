<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('phonenumber')->nullable();
            $table->string('adresse');
            $table->boolean('active')->default(0)->nullable();
            $table->string('region')->nullable();
            $table->string('geolocation')->nullable();
            $table->string('chief')->nullable();
            $table->string('image')->default('defalt.jpg');
            $table->string('status')->nullable();
            $table->string('regional_direction')->nullable();
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agences');
    }
}
