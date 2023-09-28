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
                            <th>Tanggal Accept Pinjam</th>
                            <th>Tanggal Accept Pengembalian</th>
                            <th>Action</th>
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
                            <th>Tanggal Accept Pinjam</th>
                            <th>Tanggal Accept Pengembalian</th>
                            <th>Action</th>
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
                                <td>{{$item->tgl_acc}}</td>
                                <td>{{$item->tgl_kembali}}</td>
                                <td>@if ($item->tgl_acc == null )
                                    <a href="{{route('pinjam.acc', $item->id)}}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-check" aria-hidden="true"> Accept Peminjaman</i>
                                    </a>
                                    @else
                                    @if ($item->is_done == false)
                                    <a href="{{route('pinjam.approve', $item->id)}}" class="btn btn-sm btn-success">
                                        <i class="fa fa-check" aria-hidden="true"> Accept Pengembalian</i>
                                    </a>
                                    @else
                                    <span class="badge badge-success">Selesai</span>
                                    @endif
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection