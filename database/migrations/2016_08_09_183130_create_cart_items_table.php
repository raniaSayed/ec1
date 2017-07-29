<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id');
            
            $table->integer('product_id');
            $table->string('product_image');
            $table->string('product_name')->nullable();
            $table->double('product_price', 10, 2);
            $table->string('product_currency'); 
            $table->string('product_quantity');
            $table->enum('payment_method', ['paypal', 'delivery']);

            /* 
                status:
                0: pending
                1: rejected
                2: accepted
            */
            $table->boolean("status")->default(0);
            
            $table->boolean("is_payed")->default(0);
            $table->boolean("canceled_from_owner")->default(0);

            $table->integer("accepted_at_timestamps")->nullable();
            $table->integer("payed_at_timestamps")->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cart_items');
    }
}
