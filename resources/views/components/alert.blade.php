@if (Session::has('success'))
<div class="alert alert-success" role="alert">
  {{ Session::get('success') }}
</div> 
@endif

@if ($errors->any())
<div class="alert alert-danger" role="alert">
  <ul>
    @foreach ($errors->all() as $error)
        <li><p class="text-danger">{{ $error }}</p></li>
    @endforeach
  </ul>
</div> 
@endif