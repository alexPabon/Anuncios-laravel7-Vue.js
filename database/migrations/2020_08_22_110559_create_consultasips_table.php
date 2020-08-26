<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasipsTable extends Migration
{
    /**
     * Run the migrations.
     * DataBase comments, include database/database.sqlite
     * 
     * @return void
     */
    public function up()
    {
        Schema::connection('comments')->create('consultasips', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->id();
            $table->string('number_ip',100);
            $table->string('address',100);            
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
        Schema::connection('comments')->dropIfExists('consultasips');
    }
}
