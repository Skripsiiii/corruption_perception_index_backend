<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $provinceId = [
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            22,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            38,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            33,
            37,
            37,
            37,
            37,
            37,
            37,
            37,
            37,
            37,
            37,
            34,
            34,
            34,
            34,
            34,
            34,
            34,
            34,
            34,
            34,
            34,
            34,
            35,
            35,
            35,
            35,
            35,
            35,
            35,
            36,
            36,
            36,
            36,
            36,
            36,
            36,
            36,
            36,
            36,
            36,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            16,
            16,
            16,
            16,
            16,
            16,
            16,
            16,
            16,
            16,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            17,
            17,
            17,
            17,
            17,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            5,
            5,
            5,
            5,
            5,
            5,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            7,
            7,
            7,
            7,
            7,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            19,
            19,
            19,
            19,
            19,
            19,
            21,
            21,
            21,
            21,
            21,
            21,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            20,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            18,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            24,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            23,
            26,
            26,
            26,
            26,
            26,
            26,
            26,
            26,
            26,
            26,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            28,
            28,
            28,
            28,
            28,
            28,
            28,
            27,
            27,
            27,
            27,
            27,
            27,
            27,
            27,
            27,
            29,
            29,
            29,
            29,
            29,
            29,
            29,
            29,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            30,
            30,
            30,
            30,
            32,
            32,
            32,
            32,
            32,
            32
        ];

        $cityName = [
            "Kabupaten Aceh Barat",
            "Kabupaten Aceh Barat Daya",
            "Kabupaten Aceh Besar",
            "Kabupaten Aceh Jaya",
            "Kabupaten Aceh Selatan",
            "Kabupaten Aceh Singkil",
            "Kabupaten Aceh Tamiang",
            "Kabupaten Aceh Tengah",
            "Kabupaten Aceh Tenggara",
            "Kabupaten Aceh Timur",
            "Kabupaten Aceh Utara",
            "Kabupaten Bener Meriah",
            "Kabupaten Bireuen",
            "Kabupaten Gayo Lues",
            "Kabupaten Nagan Raya",
            "Kabupaten Pidie",
            "Kabupaten Pidie Jaya",
            "Kabupaten Simeulue",
            "Kota Banda Aceh",
            "Kota Langsa",
            "Kota Lhokseumawe",
            "Kota Sabang",
            "Kota Subulussalam",
            "Kabupaten Asahan",
            "Kabupaten Batu Bara",
            "Kabupaten Dairi",
            "Kabupaten Deli Serdang",
            "Kabupaten Humbang Hasundutan",
            "Kabupaten Karo",
            "Kabupaten Labuhan batu",
            "Kabupaten Labuhan batu Selatan",
            "Kabupaten Labuhan batu Utara",
            "Kabupaten Langkat",
            "Kabupaten Mandailing Natal",
            "Kabupaten Nias",
            "Kabupaten Nias Barat",
            "Kabupaten Nias Selatan",
            "Kabupaten Nias Utara",
            "Kabupaten Padang Lawas",
            "Kabupaten Padang Lawas Utara",
            "Kabupaten Pakpak Bharat",
            "Kabupaten Samosir",
            "Kabupaten Serdang Bedagai",
            "Kabupaten Simalungun",
            "Kabupaten Tapanuli Selatan",
            "Kabupaten Tapanuli Tengah",
            "Kabupaten Tapanuli Utara",
            "Kabupaten Toba Samosir",
            "Kota Binjai",
            "Kota Gunungsitoli",
            "Kota Medan",
            "Kota Padang Sidempuan",
            "Kota Pematang siantar",
            "Kota Sibolga",
            "Kota Tanjung balai",
            "Kota Tebing Tinggi",
            "Kabupaten Banyu asin",
            "Kabupaten Empat Lawang",
            "Kabupaten Lahat",
            "Kabupaten Muara Enim",
            "Kabupaten Musi Banyu asin",
            "Kabupaten Musi Rawas",
            "Kabupaten Musi Rawas Utara",
            "Kabupaten Ogan Ilir",
            "Kabupaten Ogan Komering Ilir",
            "Kabupaten Ogan Komering Ulu",
            "Kabupaten Ogan Komering Ulu Selatan",
            "Kabupaten Ogan Komering Ulu Timur",
            "Kabupaten Penukal Abab Lematang Ilir",
            "Kota Lubuk linggau",
            "Kota Pagar Alam",
            "Kota Palembang",
            "Kota Prabumulih",
            "Kabupaten Agam",
            "Kabupaten Dharmasraya",
            "Kabupaten Kepulauan Mentawai",
            "Kabupaten Lima Puluh Kota",
            "Kabupaten Padang Pariaman",
            "Kabupaten Pasaman",
            "Kabupaten Pasaman Barat",
            "Kabupaten Pesisir Selatan",
            "Kabupaten Sijunjung",
            "Kabupaten Solok",
            "Kabupaten Solok Selatan",
            "Kabupaten Tanah Datar",
            "Kota Bukittinggi",
            "Kota Padang",
            "Kota Padang Panjang",
            "Kota Pariaman",
            "Kota Payakumbuh",
            "Kota Sawah lunto",
            "Kota Solok",
            "Kabupaten Bengkulu Selatan",
            "Kabupaten Bengkulu Tengah",
            "Kabupaten Bengkulu Utara",
            "Kabupaten Kaur",
            "Kabupaten Kepahiang",
            "Kabupaten Lebong",
            "Kabupaten Mukomuko",
            "Kabupaten Rejang Lebong",
            "Kabupaten Seluma",
            "Kota Bengkulu",
            "Kabupaten Bengkalis",
            "Kabupaten Indragiri Hilir",
            "Kabupaten Indragiri Hulu",
            "Kabupaten Kampar",
            "Kabupaten Kepulauan Meranti",
            "Kabupaten Kuantan Singingi",
            "Kabupaten Pelalawan",
            "Kabupaten Rokan Hilir",
            "Kabupaten Rokan Hulu",
            "Kabupaten Siak",
            "Kota Dumai",
            "Kota Pekanbaru",
            "Kabupaten Bintan",
            "Kabupaten Karimun",
            "Kabupaten Kepulauan Anambas",
            "Kabupaten Lingga",
            "Kabupaten Natuna",
            "Kota Batam",
            "Kota Tanjung pinang",
            "Kabupaten Batang hari",
            "Kabupaten Bungo",
            "Kabupaten Kerinci",
            "Kabupaten Merangin",
            "Kabupaten Muaro Jambi",
            "Kabupaten Sarolangun",
            "Kabupaten Tanjung Jabung Barat",
            "Kabupaten Tanjung Jabung Timur",
            "Kabupaten Tebo",
            "Kota Jambi",
            "Kota Sungai Penuh",
            "Kabupaten Lampung Barat",
            "Kabupaten Lampung Selatan",
            "Kabupaten Lampung Tengah",
            "Kabupaten Lampung Timur",
            "Kabupaten Lampung Utara",
            "Kabupaten Mesuji",
            "Kabupaten Pesawaran",
            "Kabupaten Pesisir Barat",
            "Kabupaten Pringsewu",
            "Kabupaten Tanggamus",
            "Kabupaten TulangBawang",
            "Kabupaten Tulang Bawang Barat",
            "Kabupaten Way Kanan",
            "Kota Bandar Lampung",
            "Kota Metro",
            "Kabupaten Bangka",
            "Kabupaten Bangka Barat",
            "Kabupaten Bangka Selatan",
            "Kabupaten Bangka Tengah",
            "Kabupaten Belitung",
            "Kabupaten Belitung Timur",
            "Kota Pangkal pinang",
            "Kabupaten Bengkayang",
            "Kabupaten Kapuas Hulu",
            "Kabupaten Kayong Utara",
            "Kabupaten Ketapang",
            "Kabupaten Kubu Raya",
            "Kabupaten Landak",
            "Kabupaten Melawi",
            "Kabupaten Mempawah",
            "Kabupaten Sambas",
            "Kabupaten Sanggau",
            "Kabupaten Sekadau",
            "Kabupaten Sintang",
            "Kota Pontianak",
            "Kota Singkawang",
            "Kabupaten Berau",
            "Kabupaten Kutai Barat",
            "Kabupaten Kutai Kartanegara",
            "Kabupaten Kutai Timur",
            "Kabupaten Mahakam Ulu",
            "Kabupaten Paser",
            "Kabupaten Penajam Paser Utara",
            "Kota Balikpapan",
            "Kota Bontang",
            "Kota Samarinda",
            "Kabupaten Balangan",
            "Kabupaten Banjar",
            "Kabupaten Barito Kuala",
            "Kabupaten Hulu Sungai Selatan",
            "Kabupaten Hulu Sungai Tengah",
            "Kabupaten Hulu Sungai Utara",
            "Kabupaten Kota baru",
            "Kabupaten Tabalong",
            "Kabupaten Tanah Bumbu",
            "Kabupaten Tanah Laut",
            "Kabupaten Tapin",
            "Kota Banjar baru",
            "Kota Banjarmasin",
            "Kabupaten Barito Selatan",
            "Kabupaten Barito Timur",
            "Kabupaten Barito Utara",
            "Kabupaten Gunung Mas",
            "Kabupaten Kapuas",
            "Kabupaten Katingan",
            "Kabupaten Kotawaringin Barat",
            "Kabupaten Kotawaringin Timur",
            "Kabupaten Lamandau",
            "Kabupaten Murung Raya",
            "Kabupaten Pulang Pisau",
            "Kabupaten Sukamara",
            "Kabupaten Seruyan",
            "Kota Palangka Raya",
            "Kabupaten Bulungan",
            "Kabupaten Malinau",
            "Kabupaten Nunukan",
            "Kabupaten Tana Tidung",
            "Kota Tarakan",
            "Kabupaten Lebak",
            "Kabupaten Pandeglang",
            "Kabupaten Serang",
            "Kabupaten Tangerang",
            "Kota Cilegon",
            "Kota Serang",
            "Kota Tangerang",
            "Kota Tangerang Selatan",
            "Kabupaten Kepulauan Seribu",
            "Kota Jakarta Barat",
            "Kota Jakarta Pusat",
            "Kota Jakarta Selatan",
            "Kota Jakarta Timur",
            "Kota Jakarta Utara",
            "Kabupaten Bandung",
            "Kabupaten Bandung Barat",
            "Kabupaten Bekasi",
            "Kabupaten Bogor",
            "Kabupaten Ciamis",
            "Kabupaten Cianjur",
            "Kabupaten Cirebon",
            "Kabupaten Garut",
            "Kabupaten Indramayu",
            "Kabupaten Karawang",
            "Kabupaten Kuningan",
            "Kabupaten Majalengka",
            "Kabupaten Pangandaran",
            "Kabupaten Purwakarta",
            "Kabupaten Subang",
            "Kabupaten Sukabumi",
            "Kabupaten Sumedang",
            "Kabupaten Tasikmalaya",
            "Kota Bandung",
            "Kota Banjar",
            "Kota Bekasi",
            "Kota Bogor",
            "Kota Cimahi",
            "Kota Cirebon",
            "Kota Depok",
            "Kota Sukabumi",
            "Kota Tasikmalaya",
            "Kabupaten Banjarnegara",
            "Kabupaten Banyumas",
            "Kabupaten Batang",
            "Kabupaten Blora",
            "Kabupaten Boyolali",
            "Kabupaten Brebes",
            "Kabupaten Cilacap",
            "Kabupaten Demak",
            "Kabupaten Grobogan",
            "Kabupaten Jepara",
            "Kabupaten Karanganyar",
            "Kabupaten Kebumen",
            "Kabupaten Kendal",
            "Kabupaten Klaten",
            "Kabupaten Kudus",
            "Kabupaten Magelang",
            "Kabupaten Pati",
            "Kabupaten Pekalongan",
            "Kabupaten Pemalang",
            "Kabupaten Purbalingga",
            "Kabupaten Purworejo",
            "Kabupaten Rembang",
            "Kabupaten Semarang",
            "Kabupaten Sragen",
            "Kabupaten Sukoharjo",
            "Kabupaten Tegal",
            "Kabupaten Temanggung",
            "Kabupaten Wonogiri",
            "Kabupaten Wonosobo",
            "Kota Magelang",
            "Kota Pekalongan",
            "Kota Salatiga",
            "Kota Semarang",
            "Kota Surakarta",
            "Kota Tegal",
            "Kabupaten Bantul",
            "Kabupaten Gunung kidul",
            "Kabupaten Kulon Progo",
            "Kabupaten Sleman",
            "Kota Yogyakarta",
            "Kabupaten Bangkalan",
            "Kabupaten Banyuwangi",
            "Kabupaten Blitar",
            "Kabupaten Bojonegoro",
            "Kabupaten Bondowoso",
            "Kabupaten Gresik",
            "Kabupaten Jember",
            "Kabupaten Jombang",
            "Kabupaten Kediri",
            "Kabupaten Lamongan",
            "Kabupaten Lumajang",
            "Kabupaten Madiun",
            "Kabupaten Magetan",
            "Kabupaten Malang",
            "Kabupaten Mojokerto",
            "Kabupaten Nganjuk",
            "Kabupaten Ngawi",
            "Kabupaten Pacitan",
            "Kabupaten Pamekasan",
            "Kabupaten Pasuruan",
            "Kabupaten Ponorogo",
            "Kabupaten Probolinggo",
            "Kabupaten Sampang",
            "Kabupaten Sidoarjo",
            "Kabupaten Situbondo",
            "Kabupaten Sumenep",
            "Kabupaten Trenggalek",
            "Kabupaten Tuban",
            "Kabupaten Tulungagung",
            "Kota Batu",
            "Kota Blitar",
            "Kota Kediri",
            "Kota Madiun",
            "Kota Malang",
            "Kota Mojokerto",
            "Kota Pasuruan",
            "Kota Probolinggo",
            "Kota Surabaya",
            "Kabupaten Badung",
            "Kabupaten Bangli",
            "Kabupaten Buleleng",
            "Kabupaten Gianyar",
            "Kabupaten Jembrana",
            "Kabupaten Karang asem",
            "Kabupaten Klungkung",
            "Kabupaten Tabanan",
            "Kota Denpasar",
            "Kabupaten Alor",
            "Kabupaten Belu",
            "Kabupaten Ende",
            "Kabupaten Flores Timur",
            "Kabupaten Kupang",
            "Kabupaten Lembata",
            "Kabupaten Malaka",
            "Kabupaten Manggarai",
            "Kabupaten Manggarai Barat",
            "Kabupaten Manggarai Timur",
            "Kabupaten Nagekeo",
            "Kabupaten Ngada",
            "Kabupaten Rote Ndao",
            "Kabupaten Sabu Raijua",
            "Kabupaten Sikka",
            "Kabupaten Sumba Barat",
            "Kabupaten Sumba Barat Daya",
            "Kabupaten Sumba Tengah",
            "Kabupaten Sumba Timur",
            "Kabupaten Timor Tengah Selatan",
            "Kabupaten Timor Tengah Utara",
            "Kota Kupang",
            "Kabupaten Bima",
            "Kabupaten Dompu",
            "Kabupaten Lombok Barat",
            "Kabupaten Lombok Tengah",
            "Kabupaten Lombok Timur",
            "Kabupaten Lombok Utara",
            "Kabupaten Sumbawa",
            "Kabupaten Sumbawa Barat",
            "Kota Bima",
            "Kota Mataram",
            "Kabupaten Boalemo",
            "Kabupaten Bone Bolango",
            "Kabupaten Gorontalo",
            "Kabupaten Gorontalo Utara",
            "Kabupaten Pohuwato",
            "Kota Gorontalo",
            "Kabupaten Majene",
            "Kabupaten Mamasa",
            "Kabupaten Mamuju",
            "Kabupaten Mamuju Tengah",
            "Kabupaten Mamuju Utara",
            "Kabupaten Polewali Mandar",
            "Kabupaten Banggai",
            "Kabupaten Banggai Kepulauan",
            "Kabupaten Banggai Laut",
            "Kabupaten Buol",
            "Kabupaten Donggala",
            "Kabupaten Morowali",
            "Kabupaten Morowali Utara",
            "Kabupaten Parigi Moutong",
            "Kabupaten Poso",
            "Kabupaten Sigi",
            "Kabupaten Tojo Una-Una",
            "Kabupaten Toli-toli",
            "Kota Palu",
            "Kabupaten Bolaang Mongondow",
            "Kabupaten Bolaang Mongondow Selatan",
            "Kabupaten Bolaang Mongondow Timur",
            "Kabupaten Bolaang Mongondow Utara",
            "Kabupaten Kepulauan Sangihe",
            "Kabupaten Siau Tagulandang Biaro",
            "Kabupaten Kepulauan Talaud",
            "Kabupaten Minahasa",
            "Kabupaten Minahasa Selatan",
            "Kabupaten Minahasa Tenggara",
            "Kabupaten Minahasa Utara",
            "Kota Bitung",
            "Kota Kotamobagu",
            "Kota Manado",
            "Kota Tomohon",
            "Kabupaten Bombana",
            "Kabupaten Buton",
            "Kabupaten Buton Selatan",
            "Kabupaten Buton Tengah",
            "Kabupaten Buton Utara",
            "Kabupaten Kolaka",
            "Kabupaten Kolaka Timur",
            "Kabupaten Kolaka Utara",
            "Kabupaten Konawe",
            "Kabupaten Konawe Kepulauan",
            "Kabupaten Konawe Selatan",
            "Kabupaten Konawe Utara",
            "Kabupaten Muna",
            "Kabupaten Muna Barat",
            "Kabupaten Wakatobi",
            "Kota Baubau",
            "Kota Kendari",
            "Kabupaten Bantaeng",
            "Kabupaten Barru",
            "Kabupaten Bone",
            "Kabupaten Bulukumba",
            "Kabupaten Enrekang",
            "Kabupaten Gowa",
            "Kabupaten Jeneponto",
            "Kabupaten Kepulauan Selayar",
            "Kabupaten Luwu",
            "Kabupaten Luwu Timur",
            "Kabupaten Luwu Utara",
            "Kabupaten Maros",
            "Kabupaten Pangkajene dan Kepulauan",
            "Kabupaten Pinrang",
            "Kabupaten Sidenreng Rappang",
            "Kabupaten Sinjai",
            "Kabupaten Soppeng",
            "Kabupaten Takalar",
            "Kabupaten Tana Toraja",
            "Kabupaten Toraja Utara",
            "Kabupaten Wajo",
            "Kota Makassar",
            "Kota Palopo",
            "Kota Pare-pare",
            "Kabupaten Halmahera Barat",
            "Kabupaten Halmahera Tengah",
            "Kabupaten Halmahera Timur",
            "Kabupaten Halmahera Selatan",
            "Kabupaten Halmahera Utara",
            "Kabupaten Kepulauan Sula",
            "Kabupaten Pulau Morotai",
            "Kabupaten Pulau Taliabu",
            "Kota Ternate",
            "Kota Tidore Kepulauan",
            "Kabupaten Buru",
            "Kabupaten Buru Selatan",
            "Kabupaten Kepulauan Aru",
            "Kabupaten Maluku Tenggara Barat",
            "Kabupaten Maluku Barat Daya",
            "Kabupaten Maluku Tengah",
            "Kabupaten Maluku Tenggara",
            "Kabupaten Seram Bagian Barat",
            "Kabupaten Seram Bagian Timur",
            "Kota Ambon",
            "Kota Tual",
            "Kabupaten Fak-fak",
            "Kabupaten Kaimana",
            "Kabupaten Manokwari",
            "Kabupaten Manokwari Selatan",
            "Kabupaten Pegunungan Arfak",
            "Kabupaten Teluk Bintuni",
            "Kabupaten Teluk Wondama",
            "Kabupaten Biak Numfor",
            "Kabupaten Jayapura",
            "Kabupaten Keerom",
            "Kabupaten Kepulauan Yapen",
            "Kabupaten Mamberamo Raya",
            "Kabupaten Sarmi",
            "Kabupaten Supiori",
            "Kabupaten Waropen",
            "Kota Jayapura",
            "Kabupaten Deiyai",
            "Kabupaten Dogiyai",
            "Kabupaten Intan Jaya",
            "Kabupaten Mimika",
            "Kabupaten Nabire",
            "Kabupaten Paniai",
            "Kabupaten Puncak",
            "Kabupaten Puncak Jaya",
            "Kabupaten Jayawijaya",
            "Kabupaten Lanny Jaya",
            "Kabupaten Mamberamo Tengah",
            "Kabupaten Nduga",
            "Kabupaten Pegunungan Bintang",
            "Kabupaten Tolikara",
            "Kabupaten Yalimo",
            "Kabupaten Yahukimo",
            "Kabupaten Asmat",
            "Kabupaten Boven Digoel",
            "Kabupaten Mappi",
            "Kabupaten Merauke",
            "Kabupaten Maybrat",
            "Kabupaten Raja Ampat",
            "Kabupaten Sorong",
            "Kabupaten Sorong Selatan",
            "Kabupaten Tambrauw",
            "Kota Sorong"

        ];

        // $Latitude = [
        //     -1.52019,
        //     -2.74261,
        //     -2.741051,
        //     -2.864386,
        //     -2.799463,
        //     -2.129219,
        //     -5.08974,
        //     -5.443221,
        //     -4.758037,
        //     -5.272238,
        //     -4.809424,
        //     -4.143259,
        //     -5.429034,
        //     -5.464107,
        //     -5.370833,
        //     -5.35742,
        //     -4.502235,
        //     -4.565814,
        //     -4.587998,
        //     -5.426878,
        //     -5.114875,
        //     -6.444703,
        //     -6.319608,
        //     -6.104987,
        //     -6.212303,
        //     -6.016832,
        //     -6.116187,
        //     -6.176367,
        //     -6.300491
        // ];

        // $Longtitude = [
        //     105.363377,
        //     106.440125,
        //     106.283247,
        //     107.964527,
        //     107.678618,
        //     106.113483,
        //     104.717898,
        //     105.265087,
        //     105.233624,
        //     105.843601,
        //     105.238311,
        //     105.38673,
        //     105.266536,
        //     105.181477,
        //     104.969771,
        //     104.97359,
        //     105.220421,
        //     105.131473,
        //     104.623383,
        //     105.253899,
        //     105.308367,
        //     106.093387,
        //     106.107573,
        //     106.155174,
        //     106.548445,
        //     106.033798,
        //     106.154609,
        //     106.63263,
        //     106.732878
        // ];


        //
        // DB::table("cities")->insert([
        //     "province_id" => 1, "name" => "Bangka Regency",
        //     "latitude" => -1.91667,
        //     "longitude" => 105.93333,
        //     "created_at" => Carbon::now()->toDateTimeString(), "updated_at" => Carbon::now()->toDateTimeString()
        // ]);
        // DB::table("cities")->insert(["province_id" => 1, "name" => "West Bangka Regency", "latitude" => -1.520190, "longitude" => 105.363377]);
        // DB::table("cities")->insert(["province_id" => 1, "name" => "South Bangka Regency"]);
        // DB::table("cities")->insert(["province_id" => 1, "name" => "Central Bangka Regency"]);
        // DB::table("cities")->insert(["province_id" => 1, "name" => "Belitung Regency"]);
        // DB::table("cities")->insert(["province_id" => 1, "name" => "East Belitung Regency"]);
        // DB::table("cities")->insert(["province_id" => 1, "name" => "Pangkalpinang City"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "West Lampung Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "South Lampung Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Central Lampung Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "East Lampung Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "North Lampung Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Mesuji Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Pesawaran Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "West Coast Lampung Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Pringsewu Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Tanggamus Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Tulang Bawang Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "West Tulang Bawang Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Way Kanan Regency"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Bandar Lampung City"]);
        // DB::table("cities")->insert(["province_id" => 2, "name" => "Metro City"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Lebak Regency"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Pandeglang Regency"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Serang Regency"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Tangerang Regency"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Cilegon City"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Serang City"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "Tangerang City"]);
        // DB::table("cities")->insert(["province_id" => 3, "name" => "South Tangerang City"]);

        for ($i = 0; $i < count($cityName); $i++) {
            DB::table("cities")->insert([
                "province_id" => $provinceId[$i],
                "name" => $cityName[$i],
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ]);
        }

        // DB::table("cities")->insert(["province_id" => 4, "name" => "Bandung Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "West Bandung Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Bekasi Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Bogor Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Ciamis Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Cianjur Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Cirebon Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Garut Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Indramayu Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Karawang Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Kuningan Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Majalengka Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Pangandaran Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Purwakarta Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Subang Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Sukabumi Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Sumedang Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Tasikmalaya Regency"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Bandung City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Banjar City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Bekasi City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Bogor City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Cimahi City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Cirebon City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Depok City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Sukabumi City"]);
        // DB::table("cities")->insert(["province_id" => 4, "name" => "Tasikmalaya City"]);
        // DB::table("cities")->insert(["province_id" => 5, "name" => "Kabupaten Administrasi Kepulauan Seribu"]);
        // DB::table("cities")->insert(["province_id" => 5, "name" => "West Jakarta Administrative City"]);
        // DB::table("cities")->insert(["province_id" => 5, "name" => "Central Jakarta Administrative City"]);
        // DB::table("cities")->insert(["province_id" => 5, "name" => "South Jakarta Administrative City"]);
        // DB::table("cities")->insert(["province_id" => 5, "name" => "East Jakarta Administrative City"]);
        // DB::table("cities")->insert(["province_id" => 5, "name" => "North Jakarta Administrative City "]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Banjarnegara Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Banyumas Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Batang Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Blora Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Boyolali Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Brebes Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Cilacap Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Demak Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Grobogan Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Jepara Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Karanganyar Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Kebumen Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Kendal Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Klaten Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Kudus Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Magelang Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Pati Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Pekalongan Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Pemalang Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Purbalingga Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Purworejo Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Rembang Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Semarang Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Sragen Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Sukoharjo Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Tegal Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Temanggung Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Wonogiri Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Wonosobo Regency"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Magelang City"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Pekalongan City"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Salatiga City"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Semarang City"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Surakarta City"]);
        // DB::table("cities")->insert(["province_id" => 6, "name" => "Tegal City"]);
        // DB::table("cities")->insert(["province_id" => 7, "name" => "Bantul Regency"]);
        // DB::table("cities")->insert(["province_id" => 7, "name" => "Gunungkidul Regency"]);
        // DB::table("cities")->insert(["province_id" => 7, "name" => "Kulon Progo Regency"]);
        // DB::table("cities")->insert(["province_id" => 7, "name" => "Sleman Regency"]);
        // DB::table("cities")->insert(["province_id" => 7, "name" => "Yogyakarta City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Bangkalan"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Banyuwangi"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Blitar"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Bojonegoro"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Bondowoso"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Gresik"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Jember"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Jombang"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Kediri"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Lamongan"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Lumajang"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Madiun"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Magetan"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Malang"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Mojokerto"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Nganjuk"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Ngawi"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Pacitan"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Pamekasan"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Pasuruan"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Ponorogo"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Probolinggo"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Sampang"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Sidoarjo"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Situbondo"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Sumenep"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Trenggalek"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Tuban"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Tulungagung"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Batu City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Blitar City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Kediri City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Madiun City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Malang City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Mojokerto City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Pasuruan City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Probolinggo City"]);
        // DB::table("cities")->insert(["province_id" => 8, "name" => "Surabaya City"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Badung Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Bangli Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Buleleng Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Gianyar Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Jembrana Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Karangasem Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Klungkung Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Tabanan Regency"]);
        // DB::table("cities")->insert(["province_id" => 9, "name" => "Denpasar City"]);

        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Bima"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Dompu"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Lombok Barat"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Lombok Tengah"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Lombok Timur"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Lombok Utara"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Sumbawa"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kabupaten Sumbawa Barat"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kota Bima"]);
        // DB::table("cities")->insert(["province_id" => 10, "name" => "Kota Mataram"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Barat"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Barat Daya"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Besar"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Jaya"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Selatan"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Singkil"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Tamiang"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Tengah"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Tenggara"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Timur"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Aceh Utara"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Bener Meriah"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Bireuen"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Gayo Lues"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Nagan Raya"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Pidie"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Pidie Jaya"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kabupaten Simeulue"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kota Banda Aceh"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kota Langsa"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kota Lhokseumawe"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kota Sabang"]);
        // DB::table("cities")->insert(["province_id" => 11, "name" => "Kota Subulussalam"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Alor"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Belu"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Ende"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Flores Timur"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Kupang"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Lembata"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Malaka"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Manggarai"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Manggarai Barat"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Manggarai Timur"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Nagekeo"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Ngada"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Rote Ndao"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Sabu Raijua"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Sikka"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Sumba Barat"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Sumba Barat Daya"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Sumba Tengah"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Sumba Timur"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Timor Tengah Selatan"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kabupaten Timor Tengah Utara"]);
        // DB::table("cities")->insert(["province_id" => 12, "name" => "Kota Kupang"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Bengkayang"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Kapuas Hulu"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Kayong Utara"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Ketapang"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Kubu Raya"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Landak"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Melawi"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Mempawah"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Sambas"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Sanggau"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Sekadau"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kabupaten Sintang"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kota Pontianak"]);
        // DB::table("cities")->insert(["province_id" => 13, "name" => "Kota Singkawang"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Balangan"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Banjar"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Barito Kuala"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Hulu Sungai Selatan"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Hulu Sungai Tengah"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Hulu Sungai Utara"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Kotabaru"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Tabalong"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Tanah Bumbu"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Tanah Laut"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kabupaten Tapin"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kota Banjarbaru"]);
        // DB::table("cities")->insert(["province_id" => 14, "name" => "Kota Banjarmasin"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Barito Selatan"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Barito Timur"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Barito Utara"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Gunung Mas"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Kapuas"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Katingan"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Kotawaringin Barat"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Kotawaringin Timur"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Lamandau"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Murung Raya"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Pulang Pisau"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Sukamara"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kabupaten Seruyan"]);
        // DB::table("cities")->insert(["province_id" => 15, "name" => "Kota Palangka Raya"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Berau"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Kutai Barat"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Kutai Kartanegara"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Kutai Timur"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Mahakam Ulu"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Paser"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kabupaten Penajam Paser Utara"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kota Balikpapan"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kota Bontang"]);
        // DB::table("cities")->insert(["province_id" => 16, "name" => "Kota Samarinda"]);
        // DB::table("cities")->insert(["province_id" => 17, "name" => "Kabupaten Bulungan"]);
        // DB::table("cities")->insert(["province_id" => 17, "name" => "Kabupaten Malinau"]);
        // DB::table("cities")->insert(["province_id" => 17, "name" => "Kabupaten Nunukan"]);
        // DB::table("cities")->insert(["province_id" => 17, "name" => "Kabupaten Tana Tidung"]);
        // DB::table("cities")->insert(["province_id" => 17, "name" => "Kota Tarakan"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Bolaang Mongondow"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Bolaang Mongondow Selatan"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Bolaang Mongondow Timur"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Bolaang Mongondow Utara"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Kepulauan Sangihe"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Kepulauan Siau Tagulandang Biaro"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Kepulauan Talaud"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Minahasa"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Minahasa Selatan"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Minahasa Tenggara"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kabupaten Minahasa Utara"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kota Bitung"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kota Kotamobagu"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kota Manado"]);
        // DB::table("cities")->insert(["province_id" => 18, "name" => "Kota Tomohon"]);
        // DB::table("cities")->insert(["province_id" => 19, "name" => "Kabupaten Boalemo"]);
        // DB::table("cities")->insert(["province_id" => 19, "name" => "Kabupaten Bone Bolango"]);
        // DB::table("cities")->insert(["province_id" => 19, "name" => "Kabupaten Gorontalo"]);
        // DB::table("cities")->insert(["province_id" => 19, "name" => "Kabupaten Gorontalo Utara"]);
        // DB::table("cities")->insert(["province_id" => 19, "name" => "Kabupaten Pohuwato"]);
        // DB::table("cities")->insert(["province_id" => 19, "name" => "Kota Gorontalo"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Banggai"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Banggai Kepulauan"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Banggai Laut"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Buol"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Donggala"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Morowali"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Morowali Utara"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Parigi Moutong"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Poso"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Sigi"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Tojo Una-Una"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kabupaten Tolitoli"]);
        // DB::table("cities")->insert(["province_id" => 20, "name" => "Kota Palu"]);
        // DB::table("cities")->insert(["province_id" => 21, "name" => "Kabupaten Majene"]);
        // DB::table("cities")->insert(["province_id" => 21, "name" => "Kabupaten Mamasa"]);
        // DB::table("cities")->insert(["province_id" => 21, "name" => "Kabupaten Mamuju"]);
        // DB::table("cities")->insert(["province_id" => 21, "name" => "Kabupaten Mamuju Tengah"]);
        // DB::table("cities")->insert(["province_id" => 21, "name" => "Kabupaten Pasangkayu"]);
        // DB::table("cities")->insert(["province_id" => 21, "name" => "Kabupaten Polewali Mandar"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Asahan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Batu Bara"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Dairi"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Deli Serdang"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Humbang Hasundutan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Karo"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Labuhanbatu"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Labuhanbatu Selatan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Labuhanbatu Utara"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Langkat"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Mandailing Natal"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Nias"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Nias Barat"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Nias Selatan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Nias Utara"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Padang Lawas"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Padang Lawas Utara"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Pakpak Bharat"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Samosir"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Serdang Bedagai"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Simalungun"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Tapanuli Selatan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Tapanuli Tengah"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Tapanuli Utara"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kabupaten Toba"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Binjai"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Gunungsitoli"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Medan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Padang Sidempuan"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Pematangsiantar"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Sibolga"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Tanjungbalai"]);
        // DB::table("cities")->insert(["province_id" => 22, "name" => "Kota Tebing Tinggi"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Bantaeng"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Barru"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Bone"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Bulukumba"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Enrekang"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Gowa"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Jeneponto"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Kepulauan Selayar"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Luwu"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Luwu Timur"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Luwu Utara"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Maros"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Pangkajene dan Kepulauan"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Pinrang"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Sidenreng Rappang"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Sinjai"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Soppeng"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Takalar"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Tana Toraja"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Toraja Utara"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kabupaten Wajo"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kota Makassar"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kota Palopo"]);
        // DB::table("cities")->insert(["province_id" => 23, "name" => "Kota Parepare"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Bombana"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Buton"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Buton Selatan"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Buton Tengah"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Buton Utara"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Kolaka"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Kolaka Timur"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Kolaka Utara"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Konawe"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Konawe Kepulauan"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Konawe Selatan"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Konawe Utara"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Muna"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Muna Barat"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kabupaten Wakatobi"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kota Baubau"]);
        // DB::table("cities")->insert(["province_id" => 24, "name" => "Kota Kendari"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Buru"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Buru Selatan"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Kepulauan Aru"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Kepulauan Tanimbar"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Maluku Barat Daya"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Maluku Tengah"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Maluku Tenggara"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Seram Bagian Barat"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kabupaten Seram Bagian Timur"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kota Ambon"]);
        // DB::table("cities")->insert(["province_id" => 25, "name" => "Kota Tual"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Halmahera Barat"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Halmahera Tengah"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Halmahera Timur"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Halmahera Selatan"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Halmahera Utara"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Kepulauan Sula"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Pulau Morotai"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kabupaten Pulau Taliabu"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kota Ternate"]);
        // DB::table("cities")->insert(["province_id" => 26, "name" => "Kota Tidore Kepulauan"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Biak Numfor"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Jayapura"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Keerom"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Kepulauan Yapen"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Mamberamo Raya"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Sarmi"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Supiori"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kabupaten Waropen"]);
        // DB::table("cities")->insert(["province_id" => 27, "name" => "Kota Jayapura"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Fakfak"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Kaimana"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Manokwari"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Manokwari Selatan"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Pegunungan Arfak"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Teluk Bintuni"]);
        // DB::table("cities")->insert(["province_id" => 28, "name" => "Kabupaten Teluk Wondama"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Jayawijaya"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Lanny Jaya"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Mamberamo Tengah"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Nduga"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Pegunungan Bintang"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Tolikara"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Yalimo"]);
        // DB::table("cities")->insert(["province_id" => 29, "name" => "Kabupaten Yahukimo"]);
        // DB::table("cities")->insert(["province_id" => 30, "name" => "Kabupaten Asmat"]);
        // DB::table("cities")->insert(["province_id" => 30, "name" => "Kabupaten Boven Digoel"]);
        // DB::table("cities")->insert(["province_id" => 30, "name" => "Kabupaten Mappi"]);
        // DB::table("cities")->insert(["province_id" => 30, "name" => "Kabupaten Merauke"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Deiyai"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Dogiyai"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Intan Jaya"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Mimika"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Nabire"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Paniai"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Puncak"]);
        // DB::table("cities")->insert(["province_id" => 31, "name" => "Kabupaten Puncak Jaya"]);
        // DB::table("cities")->insert(["province_id" => 32, "name" => "Kabupaten Maybrat"]);
        // DB::table("cities")->insert(["province_id" => 32, "name" => "Kabupaten Raja Ampat"]);
        // DB::table("cities")->insert(["province_id" => 32, "name" => "Kabupaten Sorong"]);
        // DB::table("cities")->insert(["province_id" => 32, "name" => "Kabupaten Sorong Selatan"]);
        // DB::table("cities")->insert(["province_id" => 32, "name" => "Kabupaten Tambrauw"]);
        // DB::table("cities")->insert(["province_id" => 32, "name" => "Kota Sorong"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Agam"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Dharmasraya"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Kepulauan Mentawai"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Lima Puluh Kota"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Padang Pariaman"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Pasaman"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Pasaman Barat"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Pesisir Selatan"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Sijunjung"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Solok"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Solok Selatan"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kabupaten Tanah Datar"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Bukittinggi"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Padang"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Padang Panjang"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Pariaman"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Payakumbuh"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Sawahlunto"]);
        // DB::table("cities")->insert(["province_id" => 33, "name" => "Kota Solok"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Bengkalis"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Indragiri Hilir"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Indragiri Hulu"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Kampar"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Kepulauan Meranti"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Kuantan Singingi"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Pelalawan"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Rokan Hilir"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Rokan Hulu"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kabupaten Siak"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kota Dumai"]);
        // DB::table("cities")->insert(["province_id" => 34, "name" => "Kota Pekanbaru"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kabupaten Bintan"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kabupaten Karimun"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kabupaten Kepulauan Anambas"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kabupaten Lingga"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kabupaten Natuna"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kota Batam"]);
        // DB::table("cities")->insert(["province_id" => 35, "name" => "Kota Tanjungpinang"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Batanghari"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Bungo"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Kerinci"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Merangin"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Muaro Jambi"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Sarolangun"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Tanjung Jabung Barat"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Tanjung Jabung Timur"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kabupaten Tebo"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kota Jambi"]);
        // DB::table("cities")->insert(["province_id" => 36, "name" => "Kota Sungai Penuh"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Bengkulu Selatan"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Bengkulu Tengah"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Bengkulu Utara"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Kaur"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Kepahiang"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Lebong"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Mukomuko"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Rejang Lebong"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kabupaten Seluma"]);
        // DB::table("cities")->insert(["province_id" => 37, "name" => "Kota Bengkulu"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Banyuasin"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Empat Lawang"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Lahat"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Muara Enim"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Musi Banyuasin"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Musi Rawas"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Musi Rawas Utara"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Ogan Ilir"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Ogan Komering Ilir"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Ogan Komering Ulu"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Ogan Komering Ulu Selatan"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Ogan Komering Ulu Timur"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kabupaten Penukal Abab Lematang Ilir"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kota Lubuklinggau"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kota Pagar Alam"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kota Palembang"]);
        // DB::table("cities")->insert(["province_id" => 38, "name" => "Kota Prabumulih"]);
    }
}
