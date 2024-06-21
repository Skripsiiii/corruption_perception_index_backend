<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_1', 'name' => 'Dimensi Persepsi Anda tentang Kemampuan Daya Saing Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_2', 'name' => 'Dimensi Persepsi Anda tentang Potensi Korupsi di Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_3', 'name' => 'Dimensi Persepsi Anda tentang Potensi Korupsi Terkait Mekanisme Keuangan di Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_4', 'name' => 'Dimensi Persepsi Anda tentang Kecenderungan Dorongan Korupsi di Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_5', 'name' => 'Dimensi Persepsi Anda tentang Dampak Korupsi di Kabupaten/Kota yang Dirasakan','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_6', 'name' => 'Dimensi Persepsi Anda tentang Penilaian terhadap Integritas Bisnis Di Lingkungan Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_7', 'name' => 'Dimensi Persepsi Anda tentang Resiko Suap Berdasarkan Lapangan Usaha di Lingkungan Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_8', 'name' => 'Dimensi Persepsi Anda tentang INTEGRITAS LAYANAN DILIHAT DARI KETERSEDIAAN BERBAGAI PROSEDUR DALAM MELAYANI MASYARAKAT di Lingkungan Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_9', 'name' => 'Dimensi Penilaian Anda tentang IMPLEMENTASI BERBAGAI PROSEDUR DALAM MELAYANI MASYARAKAT di Lingkungan Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_10','name' => 'Dimensi Persepsi Anda tentang Sistem Integritas Lokal di Lingkungan Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_11','name' => 'Dimensi Persepsi Anda terhadap Perilaku Korup Aparat di Lingkungan Kabupaten/Kota','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_12','name' => 'Dimensi Persepsi Anda terhadap Pengetahuan Aparat di Lingkungan Kabupaten/Kota tentang Tentang Strategi Pencegahan Dan Pemberantasan Korupsi','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_13','name' => 'Dimensi Kecerdasan Aparat di Lingkungan Kabupaten/Kota dalam Melawan Korupsi / Kemampuan Mengendalikan Diri Tidak Korupsi dan Menerima Suap (Against-Corruption Quotient)','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_14','name' => 'Dimensi Persepsi terhadap Integritas Layanan Tingkat Provinsi tentang STANDAR KERJA','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_15','name' => 'Dimensi Persepsi terhadap IMPLEMENTASI Integritas Layanan Tingkat Provinsi tentang STANDAR KERJA','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_16','name' => 'Dimensi Persepsi terhadap Integritas Layanan oleh Pemerintah Pusat tentang STANDAR KERJA','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
        DB::table('dimensions')->insert(['questionnaire_id' => 2, 'dimension_number' => 'DIM_17','name' => 'Dimensi Persepsi terhadap IMPLEMENTASI PROSEDUR KERJA di Lingkungan Pemerintah Pusat','created_at' => Carbon::now()->toDateTimeString(),'updated_at' => Carbon::now()->toDateTimeString()]);
    }
}
