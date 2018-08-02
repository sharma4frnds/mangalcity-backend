<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('post_id')->unsigned();
            $table->integer('spam_tag')->unsigned();
            $table->enum('status',['active','inactive']);
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts');
             $table->foreign('spam_tag')->references('id')->on('spam_tags');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
