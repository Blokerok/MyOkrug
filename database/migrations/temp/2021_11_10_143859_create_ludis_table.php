<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ludis', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000)->nullable();
            $table->string('alias',1000)->nullable();
            $table->string('description',1000)->nullable();
            $table->string('h1',1000)->nullable();
            $table->string('img',1000)->nullable();
            $table->longText('text');
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
        Schema::dropIfExists('ludis');
    }
}
