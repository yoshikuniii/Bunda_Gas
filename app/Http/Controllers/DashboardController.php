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

    public function index(Request $request)
    {
        $currentTime = time();

        if ($request->month == null and $request->year == null) {
            $inputMonth = date("n", $currentTime);
            $inputYear = date("Y", $currentTime);
        } else {
            $inputYear = $request->year;
            $inputMonth = $request->month;
        }

        if ($request->year == null) {
            $inputYear = date("Y", $currentTime);
        }

        if ($request->month == null) {
            $inputMonth = date("n", $currentTime);
            // $inputMonth = "all";
        }

        $totalMonthEarnings = 0;
        $totalYearEarnings = 0;

        if ($inputMonth == "all") {
            $totalYearEarnings = Penjualan::select(DB::raw("CAST(SUM(total_harga) as unsigned int) as total_harga"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)->first()->total_harga;

            $totalYearEarnings = $totalYearEarnings;
            $totalMonthEarnings = $totalYearEarnings / 12;

            // data untuk chart gas
            $jumlah_gas = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_gas"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("jenis_barang"), "=", "gas")
            ->groupBy(DB::raw("month(tanggal_transaksi)"))
            ->pluck('jumlah_gas');

            // data untuk chart galon
            $jumlah_galon = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_galon"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("jenis_barang"), "=", "galon")
            ->groupBy(DB::raw("month(tanggal_transaksi)"))
            ->pluck('jumlah_galon');

            $label_gas = array(
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", 
                "Jul", "Augs", "Sept", "Oct", "Nov", "Des");
            $label_galon = $label_gas;

            return view('dashboard.index', compact('jumlah_gas', 'jumlah_galon', 'label_gas', 'label_galon'))
            ->with('totalMonthEarnings', number_format($totalMonthEarnings))
            ->with('totalYearEarnings', number_format($totalYearEarnings))
            ->with('yearSelected', $inputYear)
            ->with('monthSelected', "Semua Bulan")
            ->with('monthValue', "all");

        } else {
            $totalYearEarnings = Penjualan::select(DB::raw("CAST(SUM(total_harga) as unsigned int) as total_harga_year"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)->first()->total_harga_year;

            $totalMonthEarnings = Penjualan::select(DB::raw("CAST(SUM(total_harga) as unsigned int) as total_harga_month"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("month(tanggal_transaksi)"), "=", $inputMonth)->first()->total_harga_month;

            // data untuk chart gas
            $jumlah_gas = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_gas"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("month(tanggal_transaksi)"), "=", $inputMonth)
            ->where(DB::raw("jenis_barang"), "=", "gas")
            ->groupBy(DB::raw("day(tanggal_transaksi)"))
            ->pluck('jumlah_gas');

            // data untuk chart galon
            $jumlah_galon = Penjualan::select(DB::raw("CAST(SUM(jumlah_barang) as int) as jumlah_galon"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("month(tanggal_transaksi)"), "=", $inputMonth)
            ->where(DB::raw("jenis_barang"), "=", "galon")
            ->groupBy(DB::raw("day(tanggal_transaksi)"))
            ->pluck('jumlah_galon');


            $label_gas = Penjualan::select(DB::raw("day(tanggal_transaksi) as label_gas"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("month(tanggal_transaksi)"), "=", $inputMonth)
            ->where(DB::raw("jenis_barang"), "=", "gas")
            ->groupBy(DB::raw("day(tanggal_transaksi)"))
            ->pluck("label_gas");


            $label_galon = Penjualan::select(DB::raw("day(tanggal_transaksi) as label_galon"))
            ->where(DB::raw("year(tanggal_transaksi)"), "=", $inputYear)
            ->where(DB::raw("month(tanggal_transaksi)"), "=", $inputMonth)
            ->where(DB::raw("jenis_barang"), "=", "galon")
            ->groupBy(DB::raw("day(tanggal_transaksi)"))
            ->pluck("label_galon");

            // dd($label_gas);

            return view('dashboard.index', compact('jumlah_gas', 'jumlah_galon', 'label_gas', 'label_galon'))
            ->with('totalMonthEarnings', number_format($totalMonthEarnings))
            ->with('totalYearEarnings', number_format($totalYearEarnings))
            ->with('yearSelected', $inputYear)
            ->with('monthSelected', date('F', mktime(0,0,0, $inputMonth, 10)))
            ->with('monthValue', $inputMonth);
        }
    }
}
