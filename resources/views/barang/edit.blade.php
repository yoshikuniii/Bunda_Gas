@extends('layout.template')
@section('title', 'Barang - Edit')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data : {{ $data->jenis }} {{ $data->merk }}</h1>
<!-- <p class="mb-4">
    Deskripsi Page di sini
</p> -->

<!-- START FORM -->
<form action="{{ url('barang/'.$data->id)}}" method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="jenis" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
                <input type="text" value="{{ $data->jenis }}" class="form-control" name='jenis' id="Jenis">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="merk" class="col-sm-2 col-form-label">Merk Barang</label>
            <div class="col-sm-10">
                <input type='text' value="{{ $data->merk }}" name="merk" id="merk" class="form-control" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual (Rp)</label>
            <div class="col-sm-10">
                <input type="number" value="{{ $data->harga_jual }}" class="form-control" name='harga_jual' id="harga_jual">
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