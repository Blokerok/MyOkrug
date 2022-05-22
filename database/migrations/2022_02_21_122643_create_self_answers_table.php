<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('self_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vopros_id');
            $table->foreign('vopros_id')->references('id')->on('vopros')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->index();
            $table->text('answer');
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
        Schema::dropIfExists('self_answers');
    }
}
