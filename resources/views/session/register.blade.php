@extends('layout.template')

@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
	<div class="w-50 center border rounded px-3 py-3 mx-auto">
		<h1>Register</h1>
		<form action="/session/create" method="POST">
			@csrf
			<div class="mb-3">
				<label for="name" class="form-label">Nama</label>
				<input value="{{ Session::get('name') }}" type="text" name="name" class="form-control">
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input value="{{ Session::get('email') }}" type="email" name="email" class="form-control">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="mb-3" d-grid>
				<button name="submit" type="submit" class="btn btn-primary">Register</button>
			</div>
		</form>
	</div>
</div>
@endsection