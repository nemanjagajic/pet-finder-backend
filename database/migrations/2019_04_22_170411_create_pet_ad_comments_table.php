<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetAdCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_ad_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('pet_ad_id')->unsigned();
            $table->timestamps();

            $table->foreign('pet_ad_id')->references('id')->on('pet_ads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_ad_comments');
    }
}
