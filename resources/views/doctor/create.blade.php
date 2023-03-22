@extends('layouts.app')

@push('css')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="bg-light col-lg-10 offset-lg-1 pb-4">
            <div class="d-flex justify-content-between p-6 bg-dark hadline-bg mb-4">
                <h4 class="mb-0 text-light">Add New Doctor</h4>
                <a href="{{ route('doctor.index') }}" class="btn btn-info btn-sm">Doctors List</a>
            </div>
            <div class="form-wrapper d-flex flex-column align-items-center">
                <form class="doctor-form" action="{{ route('doctor.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Doctor's Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select name="department_id" id="department" class="form-control">
                            <option value="">-- Select --</option>
                            @if(count($departments) > 0)
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                            
                            @else
                            <option value="">None</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="">
                    </div>
                    <div class="mb-3">
                        <label for="fee" class="form-label">Fee</label>
                        <input type="text" name="fee" class="form-control" id="fee" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush