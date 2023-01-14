<?php

namespace App\Http\Controllers;

use App\Models\Barang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Barang::orderBy('id', 'asc')->paginate();

        return view('barang.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("barang.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('jenis', $request->jenis);
        Session::flash('merk', $request->merk);
        Session::flash('harga_jual', $request->harga_jual);

        $request->validate([
            'jenis' => 'required',
            'merk' => 'required',
            'harga_jual' => 'required|numeric|min:0'
        ]);

        $data = [
            'jenis' => $request->jenis,
            'merk' => $request->merk,
            'harga_jual' => $request->harga_jual
        ];

        Barang::create($data);
        return redirect()->to('barang')->with('success', 'Berhasil menambahkan data!');
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
        $data = barang::where('id', $id)->first();

        return view('barang.edit')
        ->with('data', $data);
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
        Session::flash('jenis', $request->jenis);
        Session::flash('merk', $request->merk);
        Session::flash('harga_jual', $request->harga_jual);

        $request->validate([
            'jenis' => 'required',
            'merk' => 'required',
            'harga_jual' => 'required|numeric'
        ]);

        $data = [
            'jenis' => $request->jenis,
            'merk' => $request->merk,
            'harga_jual' => $request->harga_jual
        ];

        Barang::where('id', $id)->update($data);
        return redirect()->to('barang')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        barang::where('id', $id)->delete();
        return redirect()->to('barang')->with('success', 'Data dihapus!');
    }
}
