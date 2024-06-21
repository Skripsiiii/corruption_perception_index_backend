<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("users")->insert([
            [
                "role_id" => 1,
                "name" => "Chelsey",
                // "username" => "chelsey",
                "gender" => "Female",
                "age_id" => 1,
                "education_id" => 1,
                "email" => "chelsey@gmail.com",
                "password" => bcrypt("chelsey"),
                "is_accepted" => true,
                "accepted_at" => Carbon::now()->toDateTimeString(),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
                "email_verified_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "role_id" => 2,
                "name" => "Jose",
                // "username" => "jose",
                "gender" => "Male",
                "age_id" => 1,
                "education_id" => 2,
                "email" => "jose@gmail.com",
                "password" => bcrypt("jose"),
                "is_accepted" => true,
                "accepted_at" => Carbon::now()->toDateTimeString(),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
                "email_verified_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "role_id" => 3,
                "name" => "josua",
                // "username" => "josua",
                "gender" => "Male",
                "age_id" => 1,
                "education_id" => 2,
                "email" => "josua@gmail.com",
                "password" => bcrypt("josua"),
                "is_accepted" => true,
                "accepted_at" => Carbon::now()->toDateTimeString(),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
                "email_verified_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "role_id" => 3,
                "name" => "dummy",
                // "username" => "dummy",
                "gender" => "Male",
                "age_id" => 1,
                "education_id" => 2,
                "email" => "dummy@gmail.com",
                "password" => bcrypt("dummy"),
                "is_accepted" => true,
                "accepted_at" => Carbon::now()->toDateTimeString(),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
                "email_verified_at" => Carbon::now()->toDateTimeString()
            ]
        ]);

        $faker = Faker::create();

        for ($i=1; $i <= 10; $i++) {
            $name = $faker->name;
            DB::table("users")->insert([
                "role_id" => 2,
                "name" => $name,
                // "username" => $name,
                "gender" => $faker->randomElement(['Male', 'Female']),
                "age_id" => 1,
                "education_id" => 2,
                "email" => str_replace(" ", ".", $name) . "@email.com",
                "password" => bcrypt($name),
                "is_accepted" => true,
                "accepted_at" => Carbon::now()->toDateTimeString(),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
                "email_verified_at" => Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
