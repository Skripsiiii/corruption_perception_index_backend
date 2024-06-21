<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_results', function (Blueprint $table) {
            $table->unsignedBigInteger("response_id");
            $table->foreign("response_id")->references("id")->on("responses")->onUpdate("cascade")->onDelete("cascade");

            $table->unsignedBigInteger("indicator_id");
            $table->foreign("indicator_id")->references("id")->on("indicators")->onUpdate("cascade")->onDelete("cascade");

            $table->double("corruption_index");

            $table->timestamps();
            $table->primary(['response_id', 'indicator_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_results');
    }
}
