<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advert_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->unique(array('advert_id','category_id'));

            $table->foreign('advert_id')->references('id')->on('adverts')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('advert_category');
    }
}
