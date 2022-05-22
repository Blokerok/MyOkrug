<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotokonkursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotokonkurs', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000);
            $table->string('alias',1000)->nullable();
            $table->string('description',1000)->nullable();
            $table->string('img',1000)->nullable();
            $table->string('baner',1000)->nullable();
            $table->Text('mini_text')->nullable();
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
        Schema::dropIfExists('fotokonkurs');
    }
}
