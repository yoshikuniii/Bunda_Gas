<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;

        if (strlen($katakunci)) {
            $data = Galon::where('jenis_galon', 'like', "%$katakunci%")
                ->orWhere('nama_pengirim', 'like', "%$katakunci%")
                ->orWhere('nama_penerima', 'like', "%$katakunci%")
                ->orWhere('alamat_penerima', 'like', "%$katakunci%")
                ->orWhere('nomor_telepon_penerima', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = Galon::orderBy('tanggal_pembelian', 'desc')->paginate($jumlahbaris);
        }

        return view('galon.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("galon.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('jenis_galon', $request->jenis_galon);
        Session::flash('jumlah_galon', $request->jumlah_galon);
        Session::flash('tanggal_pembelian', $request->tanggal_pembelian);
        Session::flash('nama_pengirim', $request->nama_pengirim);
        Session::flash('nama_penerima', $request->nama_penerima);
        Session::flash('alamat_penerima', $request->alamat_penerima);
        Session::flash('nomor_telepon_penerima', $request->nomor_telepon_penerima);
        

        $request->validate([
            'jumlah_galon' => 'required|numeric',
            'tanggal_pembelian' => 'required',
            'nama_pengirim' => 'required',
            'nama_penerima' => 'required',
            'alamat_penerima' => 'required',
            'nomor_telepon_penerima' => 'required',
        ]);

        $data = [
            // 'id' => $request->id,
            'jenis_galon' => $request->jenis_galon,
            'jumlah_galon' => $request->jumlah_galon,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'nama_pengirim' => $request->nama_pengirim,
            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'nomor_telepon_penerima' => $request->nomor_telepon_penerima
        ];

        Galon::create($data);
        return redirect()->to('dashboard/penjualan_galon')->with('success', 'Data added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Galon::where('id', $id)->first();
        return view('galon.edit')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Galon::where('id', $id)->first();
        return view('galon.edit')->with('data', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Galon::where('id', $id)->delete();
        return redirect()->to('dashboard/penjualan_galon')->with('success', 'Data deleted!');
    }
}
