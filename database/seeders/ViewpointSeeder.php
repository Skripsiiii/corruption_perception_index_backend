<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 1, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 2, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 3, "is_effective" => 0, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 4, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 5, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 6, "is_effective" => 0, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 7, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 1,"viewpoint_type_id" => 8, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);

        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 1, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 2, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 3, "is_effective" => 0, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 4, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 5, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 6, "is_effective" => 0, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 7, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table("viewpoints")->insert(["user_id" => 3,"viewpoint_type_id" => 8, "is_effective" => 1, "created_at" => Carbon::now()->toDateTimeString(),"updated_at" => Carbon::now()->toDateTimeString()]);

    }
}
