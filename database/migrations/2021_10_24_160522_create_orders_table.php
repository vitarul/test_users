<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->float('shipping_amount', 12, 2)->default(0);
            $table->float('products_amount', 12, 2)->default(0);
            $table->float('total_amount', 12, 2)->default(0);
            $table->string('status');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('user_carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->float('shipping_amount', 12, 2)->default(0);
            $table->float('products_amount', 12, 2)->default(0);
            $table->float('total_amount', 12, 2)->default(0);
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('user_carts');
        Schema::dropIfExists('orders');
    }
}
