<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buku = [
            [
                'judul' => 'Cantik Itu Luka',
                'pengarang' => 'Eka Kurniawan',
                'tahun_terbit' => '2002'
            ],
            [
                'judul' => 'Laut Bercerita',
                'pengarang' => 'Leila S. Chudori',
                'tahun_terbit' => '2017'
            ],
        ];
        DB::table('buku')->insert($buku);
    }
}
