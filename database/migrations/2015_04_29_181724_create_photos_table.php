<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prod')->unsigned();
            $table->string('title');
            $table->string('filename');
            $table->string('url');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('photos', function (Blueprint $table) {
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
        Schema::drop('photos');
    }

}
