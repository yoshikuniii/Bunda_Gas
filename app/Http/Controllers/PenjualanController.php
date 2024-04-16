<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class penjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $yearSelected = $request->year;

        if ($yearSelected == null) {
            $yearSelected = date("Y", time());
        }

        $data = Penjualan::select("*")
        ->where(DB::raw("year(tanggal_transaksi)"), $yearSelected)
        ->orderBy("tanggal_transaksi", "desc")->paginate(400);
        
        return view('penjualan.index')
        ->with('data', $data)
        ->with('yearSelected', $yearSelected);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = Barang::select(DB::raw("jenis as jenis_barang"))
        ->groupBy("jenis")
        ->pluck("jenis_barang");

        $merk = Barang::orderBy("merk")->get();
        
        // for ($i = 0; $i < count($jenis); $i++) {
        //     echo $jenis[$i];
        //     foreach ($merk as $m) {
        //         if ($m->jenis == $jenis[$i]) {
        //             echo $m->merk;
        //         }
        //     }
        // }

        return view("penjualan.create")
        ->with('jenis', $jenis)
        ->with('merk', $merk);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Session::flash('jenis_barang', $request->jenis_barang);
        Session::flash('merk_barang', $request->merk_barang);
        Session::flash('jumlah_barang', $request->jumlah_barang);
        Session::flash('tanggal_transaksi', $request->tanggal_transaksi);
        Session::flash('nama_pengirim', $request->nama_pengirim);
        Session::flash('nama_penerima', $request->nama_penerima);
        Session::flash('alamat_penerima', $request->alamat_penerima);
        Session::flash('nomor_telepon_penerima', $request->nomor_telepon_penerima);

        $request->validate([
            // 'jenis_barang' => 'required',
            'merk_barang' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            // 'tanggal_transaksi' => 'required',
            'nama_pengirim' => 'required',
            'alamat_penerima' => 'required',
            'nomor_telepon_penerima' => 'required|numeric',
        ]);

        $jenis_barang = $barangId = Barang::where('merk', $request->merk_barang)->first()->jenis;

        $data = [
            'id_transaksi' => time(),
            // 'tanggal_transaksi' => $request->tanggal_transaksi,
            'tanggal_transaksi' => date('Y-m-d H:i:s'),
            'jenis_barang' => $jenis_barang,
            'merk_barang' => $request->merk_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $request->jumlah_barang * Barang::where("merk", "=", $request->merk_barang)->first()->harga_jual,
            'id_pengirim' => Auth::user()->id,
            'nama_pengirim' => Auth::user()->name,
            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'nomor_telepon_penerima' => $request->nomor_telepon_penerima
        ];

        Penjualan::create($data);
        return redirect()->to('penjualan')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = Barang::select(DB::raw("jenis as jenis_barang"))
        ->groupBy("jenis")
        ->pluck("jenis_barang");

        $merk = Barang::orderBy("merk")->get();

        $data = Penjualan::where('id', $id)->first();

        return view('penjualan.edit')
        ->with('data', $data)
        ->with('jenis', $jenis)
        ->with('merk', $merk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Session::flash('jenis_barang', $request->jenis_barang);
        Session::flash('merk_barang', $request->merk_barang);
        Session::flash('tanggal_transaksi', $request->tanggal_transaksi);
        Session::flash('nama_pengirim', $request->nama_pengirim);
        Session::flash('nama_penerima', $request->nama_penerima);
        Session::flash('alamat_penerima', $request->alamat_penerima);
        Session::flash('nomor_telepon_penerima', $request->nomor_telepon_penerima);

        $request->validate([
            // 'jenis_barang' => 'required',
            'merk_barang' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required',
            'nama_pengirim' => 'required',
            'alamat_penerima' => 'required',
            'nomor_telepon_penerima' => 'required|numeric',
        ]);

        $data = [
            'tanggal_transaksi' => $request->tanggal_transaksi,
            // 'jenis_barang' => $request->jenis_barang,
            'merk_barang' => $request->merk_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $request->jumlah_barang * Barang::where("merk", "=", $request->merk_barang)->first()->harga_jual,
            'nama_pengirim' => $request->nama_pengirim,
            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'nomor_telepon_penerima' => $request->nomor_telepon_penerima
        ];

        Penjualan::where('id', $id)->update($data);
        return redirect()->to('penjualan')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penjualan::where('id', $id)->delete();
        return redirect()->to('penjualan')->with('success', 'Data dihapus!');
    }
}
