<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'Cake'],
            ['nama' => 'Roti'],
            ['nama' => 'Minuman'],
            ['nama' => 'Penitip'],
            ['nama' => 'Hampers'],
        ];
        \App\Models\Jenis::create($data);
    }
}
