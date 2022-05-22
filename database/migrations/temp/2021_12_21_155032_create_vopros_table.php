<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vopros', function (Blueprint $table) {
            $table->id();
            $table->string('vopros',2000);
            $table->unsignedBigInteger('opros_id');
            $table->foreign('opros_id')->references('id')->on('opros')->cascadeOnDelete();
            $table->unsignedBigInteger('voices');
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
        Schema::dropIfExists('vopros');
    }
}
