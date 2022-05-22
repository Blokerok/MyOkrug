<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoKonkursImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_konkurs_images', function (Blueprint $table) {
            $table->id();
            $table->string('img',1000);
            $table->unsignedBigInteger('foto_id');
            $table->foreign('foto_id')->references('id')->on('foto_konkurs_materials')->cascadeOnDelete();
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
        Schema::dropIfExists('foto_konkurs_images');
    }
}
