<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_transaksi',
        'tanggal_transaksi',
        'jenis_barang',
        'merk_barang',
        'jumlah_barang',
        'id_pengirim',
        'nama_pengirim',
        'nama_penerima',
        'alamat_penerima',
        'nomor_telepon_penerima'
    ];
    protected $table = "penjualans";
    public $timestamps = false;
}
