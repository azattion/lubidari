<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->integer('price');
            $table->integer('sale');
            $table->string('desc');
            $table->string('consist');
            $table->string('boxing');
            $table->string('size');
            $table->float('weight');
            $table->json('rating');
            $table->integer('prod_time');
            $table->boolean('status');
            $table->integer('id_cat');
            $table->softDeletes();
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
		Schema::drop('products');
	}

}
