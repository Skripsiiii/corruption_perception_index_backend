<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DomicileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("domiciles")->insert([
            "user_id" => 2,
            "city_id" => 1,
            "start_date" => "2023-01-01",
            "end_date" => "2023-05-01",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        DB::table("domiciles")->insert([
            "user_id" => 3,
            "city_id" => 10,
            "start_date" => "2023-05-01",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString()
        ]);
        $faker = Faker::create();

        for ($i=4; $i <= 10; $i++) {
            DB::table("domiciles")->insert([
                "user_id" => $i,
                "city_id" => $faker->numberBetween($min = 1, $max=500),
                "start_date" => "2023-05-01",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
