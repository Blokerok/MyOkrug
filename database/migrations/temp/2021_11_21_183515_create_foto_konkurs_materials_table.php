<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoKonkursMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_konkurs_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000);
            $table->string('phone',20);
            $table->string('alias',1000)->nullable();
            $table->string('description',1000)->nullable();
            $table->string('img',1000)->nullable();
            $table->longText('text')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('visits')->default(0);
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
        Schema::dropIfExists('foto_konkurs_materials');
    }
}
