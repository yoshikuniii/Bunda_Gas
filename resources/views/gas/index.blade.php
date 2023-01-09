@extends('layout.template')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Penjualan Gas</h1>
<!-- <p class="mb-4">
    Deskripsi Page di sini
</p> -->

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
      <a href='{{ url("dashboard/penjualan_gas/create") }}' class="btn btn-primary">+ Tambah Laporan</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Penjualan Gas
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                            <th class="col-md-4">Aksi</th>
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
                                <a href="{{ url('dashboard/penjualan_gas/'.$item->id.'/edit') }}" class="btn btn-warning btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- <a href="" class="btn btn-warning">Edit</a> -->

                                <form onsubmit="return confirm('Delete this entry?')" class='d-inline' action="{{ url('dashboard/penjualan_gas/'.$item->id) }}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <!-- <button type="submit" name="submit" class="btn btn-danger">Hapus</button> -->
                                    <button type="submit" name="submit" class="btn btn-danger btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}  
        </div>
    </div>
</div>
<!-- AKHIR DATA -->
@endsection