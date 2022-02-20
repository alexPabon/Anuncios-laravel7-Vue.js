<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('comments')->create('seen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitor_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('address',255);
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('visitor_id','seen_visitor_id_foreign')->references('id')->on('visitors')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::connection('comments')->dropIfExists('seen');
    }
}
