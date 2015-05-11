<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_order')->unsigned();
            $table->integer('id_prod')->unsigned();
            $table->integer('quantity');
            $table->softDeletes();
			$table->timestamps();
		});

        Schema::table('order_items', function(Blueprint $table){
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_items');
	}

}
