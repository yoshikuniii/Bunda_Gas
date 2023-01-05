<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gas extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_gas', 'jumlah_gas', 'tanggal_pembelian', 'nama_pengirim', 'nama_penerima', 'alamat_penerima', 'nomor_telepon_penerima'];
    protected $table = "gases";
    public $timestamps = false;
}
