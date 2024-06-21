<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewpoints', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger("viewpoint_type_id");
            $table->foreign("viewpoint_type_id")->references("id")->on("viewpoint_types")->onUpdate("cascade")->onDelete("cascade");
            $table->boolean("is_effective");
            $table->timestamps();
            $table->primary(["user_id", "viewpoint_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viewpoints');
    }
}
