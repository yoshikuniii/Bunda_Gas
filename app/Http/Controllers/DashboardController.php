<?php

namespace App\Http\Controllers;

use App\Models\Gas;
use App\Models\Galon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = date("Y", time());

        $jumlah_gas = Gas::select(DB::raw("CAST(SUM(jumlah_gas) as int) as jumlah_gas"))
        ->where(DB::raw("year(tanggal_pembelian)"), "=", $currentYear)
        ->groupBy(DB::raw("month(tanggal_pembelian)"))
        ->pluck('jumlah_gas');

        $jumlah_galon = Galon::select(DB::raw("CAST(SUM(jumlah_galon) as int) as jumlah_galon"))
        ->where(DB::raw("year(tanggal_pembelian)"), "=", $currentYear)
        ->groupBy(DB::raw("Month(tanggal_pembelian)"))
        ->pluck('jumlah_galon');

        return view('dashboard.index', compact('jumlah_gas', 'jumlah_galon'));
    }
}
