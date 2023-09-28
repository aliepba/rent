@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <a href="{{route('head-department.create')}}" class="btn btn-sm btn-primary">Tambah Head Department</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Department</th>
                            <th>Head Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($head as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->department->nama ?? "-"}}</td>
                                <td>{{$item->employee->nama ?? "-"}}<e/td>
                                <td>
                                    <a href="{{route('head-department.edit', $item->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                    <form action="{{route('head-department.destroy', $item->id)}}" method="post" class="d-inline">
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