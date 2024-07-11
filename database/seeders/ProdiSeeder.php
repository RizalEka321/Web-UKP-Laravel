<?php

namespace Database\Seeders;

use App\Models\Panduan;
use App\Models\Prodi;
use App\Models\Visimisi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_prodi'    =>  'Teknik Mesin'],
            ['nama_prodi'    =>  'Teknik Sipil'],
            ['nama_prodi'    =>  'Agribisnis'],
            ['nama_prodi'    =>  'Teknologi Rekayasa Perangkat Lunak'],
            ['nama_prodi'    =>  'Teknologi Pengolahan Hasil Ternak'],
            ['nama_prodi'    =>  'Managemen Bisnis Pariwisata'],
        ];

        $data1 = [
            'panduan' => 'ISI PANDUANKU'
        ];

        $data2 = [
            'visimisi' => 'ISI VISIMISI'
        ];

        Prodi::insert($data);
        Panduan::insert($data1);
        Visimisi::insert($data2);
    }
}
