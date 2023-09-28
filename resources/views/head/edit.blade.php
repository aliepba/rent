@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('head-department.update', $head->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select name="department_id" class="form-control" required>
                                @foreach ($departments as $depart)
                                    <option value="{{$depart->id}}" @if ($head->department_id == $depart->id)
                                        
                                    selected
                                        
                                    @endif>{{$depart->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Head</label>
                            <select name="employee_id" class="form-control" required>
                                @foreach ($employees as $emp)
                                    <option value="{{$emp->id}}" @if ($head->employee_id == $emp->id)
                                        
                                        selected
                                            
                                        @endif>{{$emp->nama}}</option>
                                @endforeach
                            </select>
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