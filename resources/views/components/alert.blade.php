@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ Session::get('success') }}
</div> 
@endif

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
    <li><p class="text-danger">{{ $error }}</p></li>
  @endforeach
</ul>
@endif