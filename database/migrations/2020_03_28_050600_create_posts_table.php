<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
         Schema::create('posts', function (Blueprint $table) {
             $table->increments('id');
             $table->bigInteger('author_id')->unsigned();
             //$table->foreign('author_id')->refrences('id')->on('users')->onDelete('restrict');
             $table->string('title');
             $table->string('slug')->unique();
             $table->text('excerpt');
             $table->text('body');
             $table->string('image')->nullable();
             $table->timestamps();
         });
         Schema::table('posts', function($table) {
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
        });
     }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
     public function down()
     {
         Schema::dropIfExists('posts');
     }
}
