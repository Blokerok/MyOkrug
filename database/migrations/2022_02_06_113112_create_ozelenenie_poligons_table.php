<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOzeleneniePoligonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ozelenenie_poligons', function (Blueprint $table) {
            $table->id();
            $table->text('coord_poligon',1000)->nullable();
            $table->unsignedBigInteger('id_green');
            $table->foreign('id_green')->references('id')->on('ozelenenies');
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
        Schema::dropIfExists('ozelenenie_poligons');
    }
}
