<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBattlePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_players', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('battle_id');
            $table->foreign('battle_id')
                ->references('id')->on('battles')
                ->onDelete('cascade');
            $table->unsignedInteger('player_id');
            $table->foreign('player_id')
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
        Schema::dropIfExists('battle_players');
    }
}
