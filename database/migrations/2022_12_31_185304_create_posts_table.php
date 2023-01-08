<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('');
            $table->string('size')->default('');
            $table->string('caption');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->bigInteger('board_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('board_id')->references('id')->on('boards')
                ->onDelete('restrict')->onUpdate('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
