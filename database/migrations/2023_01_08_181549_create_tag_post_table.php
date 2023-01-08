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
        Schema::create('tag_post', function (Blueprint $table) {
            $table->primary(['tag_id', 'post_id']);
            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('restrict')->onUpdate('cascade'); 

            $table->foreign('post_id')->references('id')->on('posts')
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
        Schema::dropIfExists('tag_post');
    }
};
