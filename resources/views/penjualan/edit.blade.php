@extends('layout.template')
@section('title', 'Penjualan - Edit')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Log</h1>
<!-- <p class="mb-4">
    Deskripsi Page di sini
</p> -->

<!-- START FORM -->
<form action="{{ url('penjualan/'.$data->id)}}" method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{-- <div class="mb-3 row">
            <label for="jenis_gas" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
                <select class="form-control" id="jenis_barang" name="jenis_barang" required focus>
                    <option value="none" selected disabled hidden>Pilih Jenis Barang</option>
                    @for ($i = 0; $i < count($jenis); $i++)
                        <option value="{{ $jenis[$i] }}" @selected($data->jenis_barang == $jenis[$i])>{{ $jenis[$i] }}</option>
                    @endfor
                </select>
            </div>
        </div>
 --}}        <div class="mb-3 row">
            <label for="jenis_gas" class="col-sm-2 col-form-label">Merk/Tipe Barang</label>
            <div class="col-sm-10">
                <select class="form-control" id="merk_barang" name="merk_barang" required focus>
                    <option value="none" selected disabled hidden>Pilih Merk/Tipe Barang</option>
                    @for ($i = 0; $i < count($jenis); $i++)
                        <optgroup label="{{ $jenis[$i] }}"></option>
                            @foreach ($merk as $m)
                                @if ($m->jenis == $jenis[$i])
                                    <option value="{{ $m->merk }}" @selected($data->merk_barang == $m->merk)>{{ $m->merk }}</option>
                                @endif
                            @endforeach
                    @endfor
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah_gas" class="col-sm-2 col-form-label">Jumlah barang</label>
            <div class="col-sm-10">
                <input type="number" value="{{ $data->jumlah_barang }}" class="form-control" name='jumlah_barang' id="jumlah_barang">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal_transaksi" class="col-sm-2 col-form-label">Tanggal transaksi</label>
            <div class="col-sm-10">
                <div class='input-group date' id='CalendarDateTime'>
                    <input type='text' value="{{ $data->tanggal_transaksi }}" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" type="datetime-local"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama_pengirim" class="col-sm-2 col-form-label">Nama Pengirim</label>
            <div class="col-sm-10">
                <input type="text" value="{{ $data->nama_pengirim }}" class="form-control" name='nama_pengirim' id="nama_pengirim">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama_penerima" class="col-sm-2 col-form-label">Nama Penerima</label>
            <div class="col-sm-10">
                <input type="text" value="{{ $data->nama_penerima }}" class="form-control" name='nama_penerima' id="nama_penerima">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat_penerima" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" value="{{ $data->alamat_penerima }}" class="form-control" name='alamat_penerima' id="alamat_penerima">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nomor_telepon_penerima" class="col-sm-2 col-form-label">Nomor HP/Telepon</label>
            <div class="col-sm-10">
                <input type="text" value="{{ $data->nomor_telepon_penerima }}" class="form-control" name='nomor_telepon_penerima' id="nomor_telepon_penerima">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection