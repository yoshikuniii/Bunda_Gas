<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{

    public function index()
    {
        
        /** calculate earnings current month 
         *  1. ambil semua barang yang ada di table Barang
         *  2. loop sebanyak barang di table Barang
         *  3. di dalam loop, 
         *     for barang in Barang
         *         jumlah_barang = barang.jumlah_barang
         *         hitung pendapatan += jumlah_barang * barang.harga
         *  4. pass ke blade index
         **/

        $currentYear = date("Y", time()); // year in integer
        $currentMonth = date("n", time()); // month in integer
        $currentMonthEarning = 0; // for storing our earnings this month

        $arrayOfId_barang= Barang::pluck('id'); // get all goods on table Barang
                                                // basically, ngambil semua barang yang ada di table Barang

        // loop sebanyak barang dalam table Barang
        for ($i = 0; $i < count($arrayOfId_barang); $i++) {
            $jumlah_barang = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_barang"))
            ->where(DB::raw("month(tanggal_transaksi)"), "=", $currentMonth)
            ->where(DB::raw("merk_barang"), "=", Barang::where("id", $i+1)->first()->merk)
            ->pluck("jumlah_barang");

            $harga = Barang::where("id", $i+1)->first()->harga_jual; // harga barang berdasarkan id
            $currentMonthEarning = $currentMonthEarning + ($jumlah_barang[0] * $harga); // hitung pendapatan
        }



        // kode di bawah ini untuk data chart

        // ambil jumlah gas yang terjual di tahun ini per bulan
        $jumlah_gas = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_gas"))
        ->where(DB::raw("year(tanggal_transaksi)"), "=", $currentYear)
        ->where(DB::raw("jenis_barang"), "=", "gas")
        ->groupBy(DB::raw("month(tanggal_transaksi)"))
        ->pluck('jumlah_gas');

        // ambil jumlah galon yang terjual di tahun ini per bulan
        $jumlah_galon = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_galon"))
        ->where(DB::raw("year(tanggal_transaksi)"), "=", $currentYear)
        ->where(DB::raw("jenis_barang"), "=", "galon")
        ->groupBy(DB::raw("month(tanggal_transaksi)"))
        ->pluck('jumlah_galon');

        return view('dashboard.index', compact('jumlah_gas', 'jumlah_galon'))
        ->with('pendapatan_bulan_ini', number_format($currentMonthEarning));
    }
}
