@extends('layout.template')
@section('content')

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil</h1>
    <!-- <p class="mb-4">
		Deskripsi Page di sini
	</p> -->
    <a href="{{ url('change-password') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Ganti Password  <i class="fas fa-arrow-right fa-sm text-white-50"></i></a>
</div>

<form action="{{ route('user.update', [Auth::user()->id]) }}" method='post'>
	@csrf
	@method('PUT')
	<div class="my-3 p-3 bg-body rounded shadow-sm">
		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ Auth::user()->name }}" class="form-control" name='name' id="name">
		    </div>
		</div>

		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ Auth::user()->email }}" class="form-control" name='email' id="email" disabled>
		    </div>
		</div>

		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Alamat</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ Auth::user()->alamat }}" class="form-control" name='alamat' id="alamat">
		    </div>
		</div>

		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Nomor Telepon</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ Auth::user()->nomor_telepon }}" class="form-control" name='nomor_telepon' id="nomor_telepon">
		    </div>
		</div>

		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Role</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ Auth::user()->role }}" class="form-control" name='role' id="role" disabled>
		    </div>
		</div>

		<div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
	</div>
</form>
@endsection
