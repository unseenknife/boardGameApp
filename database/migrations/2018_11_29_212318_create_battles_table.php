<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('battleName', 20);
            $table->date('dtPlayed');
            $table->unsignedInteger('game_id');
            $table->foreign('game_id')
                ->references('id')->on('games')
                ->onDelete('cascade');
            $table->unsignedInteger('wonBy')->nullable();
            $table->foreign('wonBy')
                ->references('id')->on('players')
                ->onDelete('cascade');
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
        Schema::dropIfExists('battles');
    }
}
