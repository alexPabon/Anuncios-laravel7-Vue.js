<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('comments')->create('visitors', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('number_ip',120)->nullable()->unique();
            $table->integer('quantity')->default(1);
            $table->string('country',120)->nullable();
            $table->string('city',120)->nullable();
            $table->string('zip',50)->nullable();
            $table->string('latitude',50)->nullable();
            $table->string('longitude',50)->nullable();
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
        Schema::connection('comments')->dropIfExists('visitors');
    }
}
