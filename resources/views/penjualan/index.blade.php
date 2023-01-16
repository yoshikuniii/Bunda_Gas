@extends('layout.template')
@section('title', 'Penjualan')
@section('content')

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Penjualan</h1>
    <!-- <p class="mb-4">
        Deskripsi Page di sini
    </p> -->
    <a href="{{ url('penjualan/create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Tambah Data  <i class="fas fa-plus fa-sm text-white-50"></i></a>
</div>

<!-- CONTAINER TABEL -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            Data Penjualan
        </h6>
        <div class="dropdown no-arrow">
            <div class="form-row align-items-center">
                <label class="row-sm-2 col-form-label">Pilih Tahun: </label>
                <form action="{{ url('penjualan') }}" method="">
                    <select class="form-control form-control-sm" name="year" onchange="this.form.submit()">
                        <option value="{{ $yearSelected }}" selected disabled hidden>{{ $yearSelected }}</option>
                        <?php $dataYears = range(date("Y"), 2000); ?>
                        @foreach ($dataYears as $dataYear)
                            <option value="{{$dataYear}}">{{$dataYear}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">Jenis Barang</th>
                        <th class="col-md-1">Merk Barang</th>
                        <th class="col-md-1">Jumlah Barang</th>
                        <th class="col-md-2">Total Harga</th>
                        <th class="col-md-2">Tanggal Transaksi</th>
                        <th class="col-md-2">Nama Pengirim</th>
                        <th class="col-md-2">Nama Penerima</th>
                        <th class="col-md-2">Alamat</th>
                        <th class="col-md-2">Nomor HP/Telepon</th>
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
                        <td>{{ $item->jenis_barang }}</td>
                        <td>{{ $item->merk_barang }}</td>
                        <td>{{ $item->jumlah_barang }}</td>
                        <td>Rp{{ number_format($item->total_harga) }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>{{ $item->nama_pengirim }}</td>
                        <td>{{ $item->nama_penerima }}</td>
                        <td>{{ $item->alamat_penerima }}</td>
                        <td>{{ $item->nomor_telepon_penerima }}</td>
                        @if (Auth::user()->role == 'admin')
                        <td>
                            <a href="{{ url('penjualan/'.$item->id.'/edit') }}" class="btn btn-warning btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                            <!-- <a href="" class="btn btn-warning">Edit</a> -->

                            <form onsubmit="return confirm('Hapus data ini?')" class='d-inline' action="{{ url('penjualan/'.$item->id) }}" method="post">
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
<!-- AKHIR DATA -->
@endsection