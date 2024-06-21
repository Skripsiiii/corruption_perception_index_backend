<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensions', function (Blueprint $table) {
            $table->id();
            $table->string("dimension_number");
            $table->unsignedBigInteger("questionnaire_id");
            $table->foreign("questionnaire_id")->references("id")->on("questionnaires")->onUpdate("cascade")->onDelete("cascade");
            $table->string("name");
            $table->timestamps();

        });

        // DB::statement('ALTER TABLE dimensions ADD CONSTRAINT check_dimension_id CHECK (id REGEXP "^DIM_[0-9]+$");');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dimensions');
    }
}
