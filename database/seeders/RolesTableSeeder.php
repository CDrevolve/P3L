<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [
            ['nama' => 'Owner'],
            ['nama' => 'Admin'],
            ['nama' => 'Manager Operasional'],
            ['nama' => 'Karyawan'],
            ['nama' => 'Customer'],

        ];
        \App\Models\Role::create($data);
    }
}
