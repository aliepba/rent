@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <a href="{{route('pegawai.create')}}" class="btn btn-sm btn-primary">Tambah Pegawai</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($employees as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->tanggal_lahir}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a href="{{route('pegawai.edit', $item->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                    <form action="{{route('pegawai.destroy', $item->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                      </form> 
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