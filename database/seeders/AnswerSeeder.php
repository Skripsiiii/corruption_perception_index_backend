<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create();
        
        for ($i=1; $i <= 638; $i++) { 
            DB::table("answers")->insert([
                "response_id" => 1,
                "question_id" => $i,
                "answer_key" => $faker->numberBetween($min = 1, $max = 10),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ]);
        }

    }
}
