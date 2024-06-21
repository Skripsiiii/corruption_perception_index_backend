<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string("indicator_number");
            $table->unsignedBigInteger("dimension_id");
            $table->foreign("dimension_id")->references("id")->on("dimensions")->onUpdate("cascade")->onDelete("cascade");
            $table->string("name");
            $table->timestamps();
        });

        // DB::statement('ALTER TABLE indicators ADD CONSTRAINT check_indicator_id CHECK (id REGEXP "^IND_[0-9]+$");');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicators');
    }
}
