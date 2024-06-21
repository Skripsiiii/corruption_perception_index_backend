<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger("questionnaire_id");
            $table->foreign("questionnaire_id")->references("id")->on("questionnaires")->onUpdate("cascade")->onDelete("cascade");
            $table->double('corruption_index')->nullable();
            $table->timestamps();
            $table->unique(["user_id", "city_id", "questionnaire_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
