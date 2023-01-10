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

		@if (Auth::user()->role == 'admin')
		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Role</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="role" name="role">
                  <option value="admin" @selected(Auth::user()->role == 'admin')>admin</option>        
                  <option value="staff" @selected(Auth::user()->role == 'staff')>staff</option>           
                </select>
		    </div>
		</div>
		@endif

		@if (Auth::user()->role == 'staff')
		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Role</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="role" name="role">    
                  <option value="staff" @selected(Auth::user()->role == 'staff')>staff</option>           
                </select>
		    </div>
		</div>
		@endif

		<div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
	</div>
</form>
@endsection
