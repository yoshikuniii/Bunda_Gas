<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_transaksi')->unique();
            $table->dateTime('tanggal_transaksi');
            $table->string('jenis_barang');
            $table->string('merk_barang');
            $table->integer('jumlah_barang');
            $table->integer('total_harga');
            $table->integer('id_pengirim');
            $table->string('nama_pengirim');
            $table->string('nama_penerima');
            $table->string('alamat_penerima');
            $table->string('nomor_telepon_penerima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
};
