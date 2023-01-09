@extends('layout.template')
@section('content')

<!-- START FORM -->
<form action='{{ url("dashboard/penjualan_galon") }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="jenis_galon" class="col-sm-2 col-form-label">Jenis galon</label>
            <div class="col-sm-10">
                <select class="form-control" id="jenis_galon" name="jenis_galon" required focus>
                  <option value="aqua">aqua</option>        
                  <option value="vit">vit</option>              
              </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah_galon" class="col-sm-2 col-form-label">Jumlah galon</label>
            <div class="col-sm-10">
                <input type="number" value="{{ Session::get('jumlah_galon') }}" class="form-control" name='jumlah_galon' id="jumlah_galon">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
            <div class="col-sm-10">
                <input type='text' value="{{ date('Y-m-d H:i:s') }}" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" type="datetime-local" />
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