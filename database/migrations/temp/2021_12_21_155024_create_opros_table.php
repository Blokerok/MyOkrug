<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opros', function (Blueprint $table) {
            $table->id();
            $table->string('title',2000);
            $table->string('alias',2000);
            $table->string('description',2000);
            $table->string('img',2000);
            $table->Text('text');
            $table->tinyInteger('stop');
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
        Schema::dropIfExists('opros');
    }
}
