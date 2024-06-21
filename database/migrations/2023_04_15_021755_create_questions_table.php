<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("indicator_id");
            $table->foreign("indicator_id")->references("id")->on("indicators")->onUpdate("cascade")->onDelete("cascade");
            $table->integer("question_number");
            $table->string("name");
            $table->string("leftmost_parameter")->default("Highly Disagree");
            $table->string("rightmost_parameter")->default("Highly Agree");
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
        Schema::dropIfExists('questions');
    }
}
