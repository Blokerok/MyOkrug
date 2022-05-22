<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDvorImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dvor_images', function (Blueprint $table) {
            $table->id();
            $table->string('img',1000);
            $table->unsignedBigInteger('dvor_id');
            $table->foreign('dvor_id')->references('id')->on('moy_dvors')->cascadeOnDelete();
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
        Schema::dropIfExists('dvor_images');
    }
}
