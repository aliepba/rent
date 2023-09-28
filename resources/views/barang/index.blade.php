@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <a href="{{route('barang.create')}}" class="btn btn-sm btn-primary">Tambah Barang</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->stock}}</td>
                                <td>
                                    <img src="{{Storage::url($item->img)}}" alt="" width="120px" height="120px">
                                </td>
                                <td>
                                    <a href="{{route('barang.edit', $item->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                    <form action="{{route('barang.destroy', $item->id)}}" method="post" class="d-inline">
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