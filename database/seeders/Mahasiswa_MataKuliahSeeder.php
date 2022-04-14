<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa_MataKuliah;

class Mahasiswa_MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = [
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' =>1,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' =>2,
                'nilai' => 'B+',
            ],
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' =>3,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' =>4,
                'nilai' => 'A',
            ],
        ];

        Mahasiswa_MataKuliah::insert($value);
    }
}
