<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class IndicatorResultSeeder extends Seeder
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
        $responseIds = [7, 8, 9, 10, 11]; // Manually specified response_id values

        foreach ($responseIds as $responseId) {
            for ($i = 1; $i <= 50; $i++) {
                DB::table('indicator_results')->insert([
                    'response_id' => $responseId,
                    'indicator_id' => $i,
                    'corruption_index' => $faker->numberBetween(1, 10),
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
        }
    }
}
