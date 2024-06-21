<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("questionnaires")->insert([
            "year" => 2022,
            "created_at" => "2022-03-21 18:09:22",
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("questionnaires")->insert([
            "year" => 2023,
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
    }
}
