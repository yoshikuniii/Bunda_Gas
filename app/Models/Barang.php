<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis',
        'merk',
        'harga_jual'
    ];
    protected $table = "barangs";
    public $timestamps = false;
}
