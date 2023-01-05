@extends('layout.template')
@section('content')

<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
    <div class="pb-3">
      <form class="d-flex" action="" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div>
        
        <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
      <a href='{{ url("penjualan_gas/create") }}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-1">Jenis Gas</th>
                <th class="col-md-1">Jumlah Gas</th>
                <th class="col-md-2">Tanggal Pembelian</th>
                <th class="col-md-2">Nama Pengirim</th>
                <th class="col-md-2">Nama Penerima</th>
                <th class="col-md-2">Alamat</th>
                <th class="col-md-2">Nomor HP/Telepon</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->jenis_gas }}</td>
                <td>{{ $item->jumlah_gas }}</td>
                <td>{{ $item->tanggal_pembelian }}</td>
                <td>{{ $item->nama_pengirim }}</td>
                <td>{{ $item->nama_penerima }}</td>
                <td>{{ $item->alamat_penerima }}</td>
                <td>{{ $item->nomor_telepon_penerima }}</td>
                <td>
                    <a href="{{ url('penjualan_gas/'.$item->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Delete this entry?')" class='d-inline' action="{{ url('penjualan_gas/'.$item->id) }}" method="post">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
       {{ $data->links() }}
  </div>
  <!-- AKHIR DATA -->
@endsection