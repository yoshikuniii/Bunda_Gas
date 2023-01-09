@extends('layout.template')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Profil</h1>
<!-- <p class="mb-4">
	Deskripsi Page di sini
</p> -->

<form action="{{ url('user/'.$data->id)}}" method='post'>
	@csrf
	@method('PUT')
	<div class="my-3 p-3 bg-body rounded shadow-sm">
		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ $data->name }}" class="form-control" name='name' id="name">
		    </div>
		</div>

		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		    	<input type="text" value="{{ $data->email }}" class="form-control" name='email' id="email">
		    </div>
		</div>

		@if (Auth::user()->role == 'admin')
		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Role</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="role" name="role">
                  <option value="admin" @selected($data->role == 'admin')>admin</option>        
                  <option value="staff" @selected($data->role == 'staff')>staff</option>           
                </select>
		    </div>
		</div>
		@endif

		@if (Auth::user()->role == 'staff')
		<div class="mb-3 row">
		    <label for="name" class="col-sm-2 col-form-label">Role</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="role" name="role">    
                  <option value="staff" @selected($data->role == 'staff')>staff</option>           
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
