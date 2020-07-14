<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        schema::create('tags',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        schema::create('post_tag',function(Blueprint $table){
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('post_id')->references('id')->on('post');
                // ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tag');
                 //->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['post_id','tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        schema::drop('post_tag');
        schema::drop('tags');
    }
}
