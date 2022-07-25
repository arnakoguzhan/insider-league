<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle');
            $table->text('imageUrl');
            $table->integer('attackRating')->default(0); // Fetch from https://www.fifaindex.com/teams/fifa21/
            $table->integer('midfieldRating')->default(0); // Fetch from https://www.fifaindex.com/teams/fifa21/
            $table->integer('defenceRating')->default(0); // Fetch from https://www.fifaindex.com/teams/fifa21/
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
        Schema::dropIfExists('teams');
    }
}
