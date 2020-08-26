<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentariesTable extends Migration
{
    /**
     * Run the migrations.
     * DataBase comments, include database/database.sqlite
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('comments')->create('commentaries', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('user_id');            
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
        Schema::connection('comments')->dropIfExists('commentaries');
    }
}
