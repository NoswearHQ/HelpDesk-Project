<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique(); 
            $table->string('profile')->nullable();
            $table->string('matricule')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('role')->default('Agent'); 
            $table->string('status')->nullable();
            $table->string('skills')->nullable();
            $table->integer('postalcode')->nullable();
            $table->integer('num_poste')->nullable();    
            $table->string('adresse')->nullable();
            $table->string('departement')->nullable();
            $table->string('building')->nullable();
            $table->smallInteger('floor_level')->nullable();
            $table->smallInteger('desk_num')->nullable();
            $table->timestamp('dateofbirth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('idap_departement')->nullable();
            $table->smallInteger('idap_tel')->nullable();
            $table->smallInteger('idap_num_poste')->nullable();
            $table->smallInteger('idap_image')->nullable();
            $table->smallInteger('leave_balance')->nullable();
            $table->timestamp('last_lot_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
