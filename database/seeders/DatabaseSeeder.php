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


        // fungsi ini akan membuat random data untuk penjualan
        $currentYear = date("Y") - 5;
        $startDate = strtotime("$currentYear-01-01 00:00:00"); // first date of current year on unix timestamp
        $jenisBarang = array("gas", "galon");
        $merkBarang = array("aqua", "vit", "3kg", "12kg");
        $namaOrang = array("Padil", "Rojak", "Jaka", "Ijas", "Rayan", "Sapwan");
        $totalHargaBarang = array("18000", "52000", "17000", "16000");

        $dataToInsert = round(365 * 5.4); // set berapa banyak data yang ingin dimasukan dari seeder

        // uncomment kode di bawah buat ngeseed data penjualan
        // for ($i = 0; $i < $dataToInsert; $i++) {
        //     $newDate = $startDate + ($i * 60 * 60 * 24);
        //     DB::table('penjualans')->insert([
        //         'id_transaksi' => time()+$i,
        //         'jenis_barang' => $jenisBarang[rand(0,1)],
        //         'merk_barang' => $merkBarang[rand(0,3)],
        //         // 'id_barang' => rand(1,4),
        //         'jumlah_barang' => rand(5,25),
        //         'total_harga' => $totalHargaBarang[rand(0,3)],
        //         'tanggal_transaksi' => date("Y-m-d H:i:s", $newDate),
        //         'id_pengirim' => 1,
        //         'nama_pengirim' => $namaOrang[rand(0,5)],
        //         'nama_penerima' => $namaOrang[rand(0,5)],
        //         'alamat_penerima' => 'alamat',
        //         'nomor_telepon_penerima' => '0812-0000-0000'
        //     ]);
        // }

        // buat akun admin default, silakan ganti passwordnya nanti
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@domain.com',
            'password'=>Hash::make('12345678'),
            'role'=>'admin',
            'alamat'=>'earth',
            'nomor_telepon'=>'911'
        ]);

        // buat bikin data barang
        DB::table('barangs')->insert([
            'jenis' => 'gas',
            'merk' => '3kg',
            'harga_jual' => 18000,
        ]);

        DB::table('barangs')->insert([
            'jenis' => 'gas',
            'merk' => '12kg',
            'harga_jual' => 52000,
        ]);

        DB::table('barangs')->insert([
            'jenis' => 'galon',
            'merk' => 'aqua',
            'harga_jual' => 17000,
        ]);

        DB::table('barangs')->insert([
            'jenis' => 'galon',
            'merk' => 'vit',
            'harga_jual' => 16000,
        ]);
    }
}
