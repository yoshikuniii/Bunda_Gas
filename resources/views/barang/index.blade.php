@extends('layout.template')
@section('content')

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    <!-- <p class="mb-4">
        Deskripsi Page di sini
    </p> -->
    <a href="{{ url('barang/create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Tambah Data  <i class="fas fa-plus fa-sm text-white-50"></i></a>
</div>

<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">

    <!-- CONTAINER TABEL -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Barang
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-1">Jenis Barang</th>
                            <th class="col-md-1">Merk Barang</th>
                            <th class="col-md-1">Harga Jual (Rp)</th>
                            @if (Auth::user()->role == 'admin')
                            <th class="col-md-4">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->jenis}}</td>
                            <td>{{ $item->merk }}</td>
                            <td>{{ number_format($item->harga_jual) }}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <a href="{{ url('barang/'.$item->id.'/edit') }}" class="btn btn-warning btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- <a href="" class="btn btn-warning">Edit</a> -->

                                <form onsubmit="return confirm('Hapus data ini?')" class='d-inline' action="{{ url('barang/'.$item->id) }}" method="post">
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
                            @endif
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR DATA -->
@endsection