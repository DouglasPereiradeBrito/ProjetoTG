<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');//->onDelete('cascade');//pode haver alteração onDelete('cascade') referente ao historico
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');//->onDelete('cascade');//pode haver alteração onDelete('cascade')
            $table->string('product_before_description');
            $table->string('product_after_description');
            $table->double('product_before_price', 10,2);
            $table->double('product_after_price', 10,2);
            $table->string('brand_before_description');
            $table->string('brand_after_description');
            $table->string('gondola_before_description');
            $table->string('gondola_after_description');
            $table->string('category_before_description');
            $table->string('category_after_description');
            $table->string('session_before_description');
            $table->string('session_after_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('historic_products');
    }
}
