<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLabelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prod')->unsigned();
            $table->integer('id_lab')->unsigned();
        });

        Schema::table('product_labels', function (Blueprint $table) {
            $table->foreign('id_lab')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('id_prod')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_labels');
    }

}
