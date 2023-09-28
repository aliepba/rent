@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('barang.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="text" class="form-control" name="stock" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="img" required />
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