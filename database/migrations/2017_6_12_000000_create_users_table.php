<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->unique();
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_admin')->default(0);
            $table->string('provider', 50)->nullable();
            $table->string('provider_id');
            $table->string('image')->default('default.png');
            $table->string('cover_image')->default('default.png');
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('address');
            $table->enum('gender',['male','female']);
            $table->enum('status', ['active','inactive']);
            $table->enum('marital_status',['yes','no'])->default('no');
            $table->string('profession',50);
            $table->string('dob',50);
            $table->string('url',50)->nullable();
            $table->tinyInteger('verified')->default('0');
            $table->tinyInteger('profile')->default('0');
            $table->enum('dob_hidden',['0','1'])->default(0);
            $table->enum('mobile_hidden',['0','1'])->default(0);
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
