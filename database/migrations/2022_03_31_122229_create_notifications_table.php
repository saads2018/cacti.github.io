<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_Id')->unsigned();
            $table->foreign('user_Id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('type', ['admin', 'customer']);
            $table->string('title',30);
            $table->text('message');
            $table->enum('status', ['seen', 'unseen'])->default('unseen');
            $table->string('photo',15);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
