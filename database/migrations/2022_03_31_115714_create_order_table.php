<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_Id')->unique(); //uniquely identifies each order
            $table->bigInteger('user_Id')->unsigned();
            $table->foreign('user_Id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('item_count');
            $table->decimal('grand_total', 20, 2);
            $table->enum('status', ['pending', 'processing', 'completed', 'decline', 'cancelled'])->default('pending');
            $table->string('delivery_type');
            $table->string('orderNumber');
            $table->string('contactMedia')->nullable();        
            $table->date('orderMadeDate');
            $table->string('shippingStartDate')->default('To Be Decided'); 
            $table->string('shippingEndDate')->default('To Be Decided'); 
            $table->string('shippingTime')->default('To Be Decided'); 
            $table->longText('denyReason')->nullable();	
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
