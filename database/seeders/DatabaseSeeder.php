<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            QuestionnaireSeeder::class,
            DimensionSeeder::class,
            IndicatorSeeder::class,
            QuestionSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            AgeSeeder::class,
            EducationSeeder::class,
            OccupationSeeder::class,
            UserSeeder::class,
            DomicileSeeder::class,
            ResponseSeeder::class,
            AnswerSeeder::class,
            DimensionResultSeeder::class,
            IndicatorResultSeeder::class,
            ViewpointTypeSeeder::class,
            ViewpointSeeder::class
        ]);
    }
}
