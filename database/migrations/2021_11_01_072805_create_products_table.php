<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('Product_ID');
            $table->string('Product_Name');
            $table->integer('Product_Quantity');
            $table->string('Product_Type');
            $table->string('Product_Desc');
            $table->integer('Product_Price');
            $table->string('Product_Supplier');
            $table->string('Product_Image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
