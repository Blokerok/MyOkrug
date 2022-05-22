<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupOprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_opros', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000);
            $table->string('alias',1000);
            $table->string('h1',1000);
            $table->string('description',2000);
            $table->string('img',2000);
            $table->text('text_page');

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
        Schema::dropIfExists('group_opros');
    }
}
