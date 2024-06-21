<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table("responses")->insert([
           "user_id" => 1,
           "city_id" => 1,
           "questionnaire_id" => 2,
           "corruption_index" => 4,
           "created_at" => Carbon::now()->toDateTimeString(),
           "updated_at" => Carbon::now()->toDateTimeString()
       ]);
       DB::table("responses")->insert([
            "user_id" => 2,
            "city_id" => 24,
            "questionnaire_id" => 2,
            "corruption_index" => 2,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 3,
            "city_id" => 35,
            "questionnaire_id" => 2,
            "corruption_index" => 3,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 4,
            "city_id" => 12,
            "questionnaire_id" => 2,
            "corruption_index" => 4,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 2,
            "city_id" => 5,
            "questionnaire_id" => 2,
            "corruption_index" => 4,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 1,
            "city_id" => 6,
            "questionnaire_id" => 2,
            "corruption_index" => 4,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 2,
            "city_id" => 338,
            "questionnaire_id" => 2,
            "corruption_index" => 60,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 1,
            "city_id" => 337,
            "questionnaire_id" => 2,
            "corruption_index" => 70,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 1,
            "city_id" => 335,
            "questionnaire_id" => 2,
            "corruption_index" => 80,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 1,
            "city_id" => 334,
            "questionnaire_id" => 2,
            "corruption_index" => 100,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("responses")->insert([
            "user_id" => 1,
            "city_id" => 336,
            "questionnaire_id" => 2,
            "corruption_index" => 100,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
    }
}
