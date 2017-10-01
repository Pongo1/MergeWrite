<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRanksTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rank_worth');
            $table->integer('rank_cost');
            $table->text('rank_description');
            $table->string('rank');
            $table->integer('number');
            $table->integer('user_id');
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
        Schema::dropIfExists('user_ranks');
    }
}
