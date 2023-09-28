@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <form action="{{route('pegawai.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" value="{{$data->nik}}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{$data->alamat}}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" value="{{$data->tgl_lahir}}" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" class="form-control" name="kontak" value="{{$data->kontak}}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$data->email}}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Deparment</label>
                            <select class="form-control" name="department_id" required>
                              @foreach ($department as $item)
                                  <option value="{{$item->id}}" @if ($item->id == $data->department_id)
                                      selected
                                  @endif>{{$item->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelamin</label>
                            <select class="form-control" name="kelamin" required>
                                <option value="Pria" @if ($data->kelamin == 'Pria')
                                    selected
                                @endif>Pria</option>
                                <option value="Wanita" @if ($data->kelamin == 'Wanita')
                                    selected
                                @endif>Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" class="form-control" name="photo" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection