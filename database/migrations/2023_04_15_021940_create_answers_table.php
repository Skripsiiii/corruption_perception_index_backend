<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->unsignedBigInteger("response_id");
            $table->foreign("response_id")->references("id")->on("responses")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("questions")->onUpdate("cascade")->onDelete("cascade");
            $table->integer("answer_key")->min(1)->max(10);
            $table->timestamps();
            $table->primary(["response_id", "question_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
