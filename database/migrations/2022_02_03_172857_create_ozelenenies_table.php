<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOzeleneniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ozelenenies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img1',1000)->nullable();
            $table->string('img2',1000)->nullable();
            $table->text('info')->nullable();
            $table->integer('visits')->default(0);
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('category_greens');
            $table->unsignedBigInteger('user_id')->index();
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
        Schema::dropIfExists('ozelenenies');
    }
}
