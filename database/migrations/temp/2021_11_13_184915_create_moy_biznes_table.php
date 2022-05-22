<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoyBiznesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moy_biznes_image', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000);
            $table->string('h1',1000);
            $table->string('alias',1000);
            $table->string('description',1000);
            $table->string('img',1000);
            $table->longText('text');
            $table->integer('likes',);
            $table->integer('visits');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('category_biznes');
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
        Schema::dropIfExists('moy_biznes_image');
    }
}
