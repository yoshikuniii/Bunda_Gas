<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // fungsi ini akan membuat data random penjualan selama setahun
        $currentYear = date("Y", time());
        $startDate = strtotime("$currentYear-01-01 00:00:00"); // first date of current year on unix timestamp
        $jenisGalon = array("aqua", "vit");
        $jenisGas = array("3kg", "12kg");
        $namaOrang = array("Padil", "Rojak", "Jaka", "Ijas", "Rayan", "Sapwan");

        for ($i = 0; $i < 365; $i++) {
            $newDate = $startDate + ($i * 60 * 60 * 24);
            DB::table('gases')->insert([
                'jenis_gas' => $jenisGas[rand(0,1)],
                'jumlah_gas' => rand(5,30),
                'tanggal_pembelian' => date("Y-m-d H:i:s", $newDate),
                'nama_pengirim' => $namaOrang[rand(0,5)],
                'nama_penerima' => $namaOrang[rand(0,5)],
                'alamat_penerima' => 'alamat',
                'nomor_telepon_penerima' => '0812-0000-0000'
            ]);

            DB::table('galons')->insert([
                'jenis_galon' => $jenisGalon[rand(0,1)],
                'jumlah_galon' => rand(5,30),
                'tanggal_pembelian' => date("Y-m-d H:i:s", $newDate),
                'nama_pengirim' => $namaOrang[rand(0,5)],
                'nama_penerima' => $namaOrang[rand(0,5)],
                'alamat_penerima' => 'alamat',
                'nomor_telepon_penerima' => '0812-0000-0000'
            ]);
        }


        // buat akun admin default, silakan ganti passwordnya nanti
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@domain.com',
            'password'=>Hash::make('12345678'),
            'role'=>'admin'
        ]);
    }
}
