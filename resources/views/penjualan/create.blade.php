@extends('layout.template')
@section('title', 'Penjualan - Tambah')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Buat Laporan Baru</h1>
<!-- <p class="mb-4">
    Deskripsi Page di sini
</p> -->

<!-- START FORM -->
<form action='{{ url("penjualan") }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{-- <div class="mb-3 row">
            <label for="jenis_gas" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
                <select class="form-control" id="jenis_barang" name="jenis_barang" required focus>
                    <option value="none" selected disabled hidden>Pilih Jenis Barang</option>
                    @for ($i = 0; $i < count($jenis); $i++)
                        <option value="{{ $jenis[$i] }}">{{ $jenis[$i] }}</option>
                    @endfor
                </select>
            </div>
        </div> --}}
        <div class="mb-3 row">
            <label for="jenis_gas" class="col-sm-2 col-form-label">Merk/Tipe Barang</label>
            <div class="col-sm-10">
                <select class="form-control" id="merk_barang" name="merk_barang" required focus>
                    <option value="none" selected disabled hidden>Pilih Merk/Tipe Barang</option>
                    @for ($i = 0; $i < count($jenis); $i++)
                        <optgroup label="{{ $jenis[$i] }}"></option>
                            @foreach ($merk as $m)
                                @if ($m->jenis == $jenis[$i])
                                    <option value="{{ $m->merk }}">{{ $m->merk }}</option>
                                @endif
                            @endforeach
                    @endfor
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah_gas" class="col-sm-2 col-form-label">Jumlah Barang</label>
            <div class="col-sm-10">
                <input type="number" value="{{ Session::get('jumlah_barang') }}" class="form-control" name='jumlah_barang' id="jumlah_barang">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal_transaksi" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
            <div class="col-sm-10">
                <input type='text' value="{{ date('Y-m-d H:i:s') }}" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" type="datetime-local" disabled />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama_pengirim" class="col-sm-2 col-form-label">Nama Pengirim</label>
            <div class="col-sm-10">
                <input type="text" value="{{ Auth::user()->name}}" class="form-control" name='nama_pengirim' id="nama_pengirim">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama_penerima" class="col-sm-2 col-form-label">Nama Penerima</label>
            <div class="col-sm-10">
                <input type="text" value="{{ Session::get('nama_penerima') }}" class="form-control" name='nama_penerima' id="nama_penerima">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat_penerima" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" value="{{ Session::get('alamat_penerima') }}" class="form-control" name='alamat_penerima' id="alamat_penerima">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nomor_telepon_penerima" class="col-sm-2 col-form-label">Nomor HP/Telepon</label>
            <div class="col-sm-10">
                <input type="text" value="{{ Session::get('nomor_telepon_penerima') }}" class="form-control" name='nomor_telepon_penerima' id="nomor_telepon_penerima">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection