<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimension_results', function (Blueprint $table) {
            $table->unsignedBigInteger("response_id");
            $table->foreign("response_id")->references("id")->on("responses")->onUpdate("cascade")->onDelete("cascade");

            $table->unsignedBigInteger("dimension_id");
            $table->foreign("dimension_id")->references("id")->on("dimensions")->onUpdate("cascade")->onDelete("cascade");

            $table->double("corruption_index");
            $table->timestamps();

            $table->primary(['response_id', 'dimension_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dimension_results');
    }
}
