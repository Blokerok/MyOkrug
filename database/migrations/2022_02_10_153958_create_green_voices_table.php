<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGreenVoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green_voices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_green');
            $table->foreign('id_green')->references('id')->on('ozelenenies')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->index();
            $table->tinyInteger('yes')->default(0);
            $table->tinyInteger('no')->default(0);
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
        Schema::dropIfExists('green_voices');
    }
}
