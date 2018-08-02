<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->text('message');
            $table->string('type',50);
            $table->string('value',100);
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->string('tag',50);
            $table->integer('spam')->default(0);
            $table->integer('share')->default(0);
            $table->integer('status')->default(1);
            $table->integer('state')->default(0);
            $table->integer('district')->default(0);
            $table->integer('city')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
