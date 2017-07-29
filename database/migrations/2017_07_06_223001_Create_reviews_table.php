<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->float('review');
            $table->string('like')->nullable();
            $table->string('dislike')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('reviews');
    }
}
