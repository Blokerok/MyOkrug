<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoybiznesimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moybiznesimages', function (Blueprint $table) {
            $table->id();
            $table->string('img',1000);
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('moy_biznes_image')->cascadeOnDelete();
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
        Schema::dropIfExists('moybiznesimages');
    }
}
