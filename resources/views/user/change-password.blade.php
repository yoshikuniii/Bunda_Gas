@extends('layout.template')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ganti Password</h1>
<!-- <p class="mb-4">
    Deskripsi Page di sini
</p> -->

<!-- START FORM -->
<form action="{{ url('change-password') }}" method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Password Sekarang</label>
            <div class="col-sm-10">
                <input type="password" value="" class="form-control" name='current_password' id="current_password">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Password Baru</label>
            <div class="col-sm-10">
                <input type="password" value="" class="form-control" name='password' id="password">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
            <div class="col-sm-10">
                <input type="password" value="" class="form-control" name="password_confirmation" id="password_confirmation">
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