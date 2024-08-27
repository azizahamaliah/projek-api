<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pegawai1 = Pegawai::create([
            'nama' => 'azizah',
            'email' => 'studieszah@gmail.com',
            'password' => Hash::make('work123space'),
        ]);

        $pegawai2 = Pegawai::create([
            'nama' => 'budi',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
