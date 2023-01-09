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
        Schema::create('galons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_galon');
            $table->integer('jumlah_galon');
            $table->dateTime('tanggal_pembelian');
            $table->string('nama_pengirim');
            $table->string('nama_penerima');
            $table->string('alamat_penerima');
            $table->string('nomor_telepon_penerima');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galons');
    }
};
