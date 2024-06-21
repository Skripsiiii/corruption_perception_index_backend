<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role_id")->default(3);
            $table->foreign("role_id")->references("id")->on("roles")->onUpdate("cascade")->onDelete("cascade");
            $table->string('name');
            // $table->string('username')->unique();
            
            $table->string("gender");

            $table->unsignedBigInteger("age_id")->nullable();
            $table->foreign("age_id")->references("id")->on("ages")->onUpdate("cascade")->onDelete("cascade");

            $table->unsignedBigInteger("education_id")->nullable();
            $table->foreign("education_id")->references("id")->on("education")->onUpdate("cascade")->onDelete("cascade");

            $table->unsignedBigInteger("occupation_id")->nullable();
            $table->foreign("occupation_id")->references("id")->on("occupations")->onUpdate("cascade")->onDelete("cascade");

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean("is_accepted")->default(true);
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->date("accepted_at")->nullable();
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
        Schema::dropIfExists('users');
    }
}
