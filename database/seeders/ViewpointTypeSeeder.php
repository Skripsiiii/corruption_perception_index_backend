<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewpointTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta melalui KONVENSI INTERNASIONAL?",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta melalui KEBIJAKAN ANTI SUAP NASIONAL?",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta melalui JURNALISME INVESTIGATIF",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta melalui FORUM MULTIPIHAK DAN AKSI BERSAMA MELAWAN SUAP",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta melalui UJI KEPATUTAN",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta dengan cara MEMASUKKAN KORUPSI DALAM STRATEGI MANAJEMEN RISIKO PERUSAHAAN",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta dengan cara melalui KURIKULUM SEKOLAH/PERGURUAN TINGGI",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
        DB::table("viewpoint_types")->insert([
            "name" => "Penilaian Anda terhadap upaya menghentikan korupsi dan suap di sektor swasta dengan cara melalui PEMBERIAN SANKSI SOSIAL",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ]);
    }
}
