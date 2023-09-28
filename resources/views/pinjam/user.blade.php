@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pinjam</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Pinjam</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pinjam as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->no_pinjam}}</td>
                                <td>{{$item->barang->nama}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->tgl_mulai}}</td>
                                <td>{{$item->tgl_akhir}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection