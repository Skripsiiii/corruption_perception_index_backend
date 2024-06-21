<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('occupations')->insert(['name' => 'Legislatif / eksekutif / Pejabat', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Anggota DPR', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Anggota DPRD Provinsi', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Anggota DPRD Kabupaten/Kota', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Anggota BPD', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Anggota BPK', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Pengacara', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Notaris', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Perangkat Desa', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Kepala Desa', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Guru', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Dosen', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Wiraswasta', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Anggota TNI dan Polri', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'PNS/ASN/Aparat Pemda', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'BUMN/BUMD', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Manajer', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Tenaga Profesional', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Teknisi dan Asisten Tenaga Profesional', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Tenaga Tata Usaha', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Tenaga Usaha Pertanian dan Peternakan', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Tenaga Usaha Jasa dan Tenaga Usaha Penjualan di Toko dan Pasar', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Tenaga Pengolahan dan Kerajinan', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Operator dan Perakit Mesin', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Pekerja Kasar, Tenaga Kebersihan, dan Tenaga Lepas', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'LSM', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Rohaniawan/wati', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Pensiunan', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
        DB::table('occupations')->insert(['name' => 'Lainnya', "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()]);
    }
}
