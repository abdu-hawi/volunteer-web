<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitiativeVolunteer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initiative_volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId("initiative_id")->constrained();
            $table->foreignId("volunteer_id")->constrained();
            $table->boolean("isAccept")->default(false);
            $table->boolean("isFinish")->default(false);
            $table->string("hours")->nullable();
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
        Schema::dropIfExists('initiative_volunteer');
    }
}
