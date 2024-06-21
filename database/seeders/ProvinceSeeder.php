<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            "Kepulauan Bangka Belitung",
            "Lampung",
            "Banten",
            "Jawa Barat",
            "Daerah Khusus Ibukota Jakarta",
            "Jawa Tengah",
            "Daerah Istimewa Yogyakarta",
            "Jawa Timur",
            "Bali",
            "Nusa Tenggara Barat",
            "Aceh",
            "Nusa Tenggara Timur",
            "Kalimantan Barat",
            "Kalimantan Selatan",
            "Kalimantan Tengah",
            "Kalimantan Timur",
            "Kalimantan Utara",
            "Sulawesi Utara",
            "Gorontalo",
            "Sulawesi Tengah",
            "Sulawesi Barat",
            "Sumatera Utara",
            "Sulawesi Selatan",
            "Sulawesi Tenggara",
            "Maluku",
            "Maluku Utara",
            "Papua",
            "Papua Barat",
            "Papua Tengah",
            "Papua Selatan",
            "Papua Tengah Barat",
            "Papua Barat Daya",
            "Sumatera Barat",
            "Riau",
            "Kepulauan Riau",
            "Jambi",
            "Bengkulu",
            "Sumatera Selatan"
        ];

        $Latitude = [
            -2.84011,
            -4.68748,
            -6.40572,
            -7.09091,
            -6.20876,
            -7.3249,
            -7.79746,
            -7.53606,
            -8.40952,
            -8.65293,
            4.69514,
            -8.65738,
            -0.27878,
            -3.09264,
            -1.68149,
            0.69309,
            2.69743,
            0.62469,
            0.59948,
            -1.43002,
            -2.84019,
            2.11509,
            -4.49373,
            -4.1298,
            -3.2303,
            1.57099,
            -4.14888,
            -1.38868,
            -4.25352,
            -5.13292,
            -3.44048,
            -4.12605,
            -0.88686,
            0.30068,
            3.94565,
            -1.61178,
            -3.57784,
            -3.31987
        ];

        $Longtitude = [
            107.52016,
            105.29031,
            106.06402,
            107.66889,
            106.8456,
            110.36178,
            110.37056,
            112.2384,
            115.18892,
            117.36186,
            96.7494,
            121.07937,
            111.47527,
            115.28376,
            113.38235,
            116.04743,
            116.16546,
            123.9756,
            122.04696,
            121.44571,
            119.23207,
            98.82812,
            120.16583,
            122.82344,
            130.14526,
            127.80895,
            138.87818,
            132.94742,
            138.38336,
            137.38238,
            135.96374,
            133.07716,
            100.37337,
            101.68418,
            108.14287,
            102.77626,
            102.34639,
            103.91422

        ];

        for($i = 0;$i<count($name);$i++){
            DB::table("provinces")->insert([
                "name" => $name[$i],
                "latitude" => $Latitude[$i],
                "longitude" => $Longtitude[$i],
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ]);
        }


        //
        // DB::table("provinces")->insert([
        //     "name" => "Bangka Belitung Island",
        //     "latitude" => -2.84011,
        //     "longitude" => 107.58394,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Lampung",
        //     "latitude" => -4.8555,
        //     "longitude" => 105.0273,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Banten",
        //     "latitude" => -6.44538,
        //     "longitude" => 106.13756,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "West Java",
        //     "latitude" => -6.88917,
        //     "longitude" => 107.64047,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Special Capital Region of Jakarta",
        //     "latitude" => -6.200000,
        //     "longitude" => 106.816666,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Central Java",
        //     "latitude" => -7.30324,
        //     "longitude" => 110.00441,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Special Region of Yogyakarta",
        //     "latitude" => -7.7956,
        //     "longitude" => 110.3695,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "East Java",
        //     "latitude" => -6.96851,
        //     "longitude" => 113.98005,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Bali",
        //     "latitude" => -8.23566,
        //     "longitude" => 115.12239,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "West Nusa Tenggara",
        //     "latitude" => -8.12179,
        //     "longitude" => 117.63696,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Aceh",
        //     "latitude" => 4.36855,
        //     "longitude" => 97.0253,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "East Nusa Tenggara",
        //     "latitude" => -8.56568,
        //     "longitude" => 120.69786,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "West Kalimantan",
        //     "latitude" => -0.13224,
        //     "longitude" => 111.09689,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "South Kalimantan",
        //     "latitude" => -2.94348,
        //     "longitude" => 115.37565,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Central Kalimantan",
        //     "latitude" => -1.49958,
        //     "longitude" => 113.29033,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "East Kalimantan",
        //     "latitude" => 0.78844,
        //     "longitude" => 116.242,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "North Kalimantan",
        //     "latitude" => 2.72594,
        //     "longitude" => 116.911,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "North Sulawesi",
        //     "latitude" => 0.65557,
        //     "longitude" => 124.09015,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Gorontalo",
        //     "latitude" => 0.71862,
        //     "longitude" => 122.45559,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Central Sulawesi",
        //     "latitude" => -1.69378,
        //     "longitude" => 120.80886,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "West Sulawesi",
        //     "latitude" => -2.49745,
        //     "longitude" => 119.3919,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "North Sumatra",
        //     "latitude" => 2.19235,
        //     "longitude" => 99.38122,
        //     "latitude" => 0.65557,
        //     "longitude" => 124.09015,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "South Sulawesi",
        //     "latitude" => -3.64467,
        //     "longitude" => 119.94719,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Southeast Sulawesi",
        //     "latitude" => -3.54912,
        //     "longitude" => 121.72796,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Maluku",
        //     "latitude" => -3.11884,
        //     "longitude" => 129.42078,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "North Maluku",
        //     "latitude" => 0.63012,
        //     "longitude" => 127.97202,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Papua",
        //     "latitude" => -3.98857,
        //     "longitude" => 138.34853,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "West Papua",
        //     "latitude" => -1.38424,
        //     "longitude" => 132.90253,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Highland Papua",
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "South Papua",
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Central Papua",
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Southwest Papua",
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "West Sumatra",
        //     "latitude" => -1.34225,
        //     "longitude" => 100.0761,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Riau",
        //     "latitude" => 0.50041,
        //     "longitude" => 101.54758,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Riau Islands",
        //     "latitude" => -0.15478,
        //     "longitude" => 104.58037,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Jambi",
        //     "latitude" => -1.61157,
        //     "longitude" => 102.7797,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "Bengkulu",
        //     "latitude" => -3.51868,
        //     "longitude" => 102.53598,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("provinces")->insert([
        //     "name" => "South Sumatra",
        //     "latitude" => -3.12668,
        //     "longitude" => 104.09306,
        //     "created_at" => Carbon::now()->toDateTimeString(),
        //     "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
    }
}
