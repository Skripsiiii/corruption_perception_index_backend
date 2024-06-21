<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class ParticipantSeeder extends Seeder
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

        DB::table("participants")->insert(["name" => "Jose Susanto", "gender" => "Male", "age_id" => 1, "education_id" => 1, "email" => "jose@email.com", "password" => bcrypt("jose"), "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Holyvia Marcella","gender" => "Female","age_id" => 2,"education_id" => 2,"email" => "holy","password" => bcrypt("holy@email.com"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Chelsey",'gender' => "Female","age_id" => 2,"education_id" => 3,"email" => "chelsey@email.com","password" => bcrypt("chelsey"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Anthony William Chandra", "gender" => "Male", "age_id" => 3, "education_id" => 1,"email" => "anthony@email.com", "password" => bcrypt("anthony"), "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Jason","gender" => "Male", "age_id" => 4, "education_id" => 4, "email" => "jason@email.com", "password" => bcrypt("jason"), "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Justin","gender" => "Male","age_id" => 3,"education_id" => 4,"email" => "justin@email.com","password" => bcrypt("justin"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Jessica Alathea","gender" => "Female","age_id" => 4,"education_id" => 2,"email" => "jessica@email.com","password" => bcrypt("jessica"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Austin","gender" => "Male","age_id" => 4,"education_id" => 1,"email" => "a@email.com","password" => bcrypt("austin"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Felicia Yolanda","gender" => "Female","age_id" => 1,"education_id" => 1,"email" => "felicia.yolanda@email.com","password" => bcrypt("felicia"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("participants")->insert(["name" => "Christian","gender" => "Male","age_id" => 3,"education_id" => 3,"email" => "christian","password" => bcrypt("christian"),"created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
         
        for ($i=1; $i <= 10; $i++) { 
            $name = $faker->name;
            DB::table("participants")->insert([
                "name" => $name,
                "gender" => $faker->randomElement(['Male', 'Female']),
                "age_id" => 1,
                "education_id" => 1,
                "email" => str_replace(" ", ".", $name) . "@email.com",
                "password" => bcrypt("password"),
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ]);
        }

    }
}
