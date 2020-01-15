<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamp('date');
            $table->integer('order_type');
            $table->integer('site_user')->unsigned()->index();
            $table->foreign('site_user')->references('id')->on('site_users')->onDelete('cascade');
            $table->integer('amount')->unsigned();
            $table->double('price', 16, 8);
            $table->enum('market_price', array('Y', 'N'))->default('N');
            $table->integer('currency');
            $table->integer('c_currency');
            $table->integer('log_id');
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
        Schema::dropIfExists('orders');
    }
}
