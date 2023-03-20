@extends('layouts.app')

@push('css')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="bg-light col-lg-10 offset-lg-1">
            <div class="d-flex justify-content-between p-6 bg-dark hadline-bg mb-4">
                <h4 class="mb-0 text-light">Update Doctor Info</h4>
                <a href="{{ route('doctor.index') }}" class="btn btn-info btn-sm">Doctors List</a>
            </div>
            <div class="form-wrapper d-flex flex-column align-items-center">
                <div class="doctor-form" >
                    <div class="mb-3">
                        <label for="name" class="form-label">Doctor's Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $doctor->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select name="department_id" id="department" class="form-control" disabled>
                            <option value="">{{ $doctor->department->name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $doctor->phone }}" disabled> 
                    </div>
                    <div class="mb-3">
                        <label for="fee" class="form-label">fee</label>
                        <input type="text" name="fee" class="form-control" id="fee" value="{{ $doctor->fee }}" disabled>
                    </div>
                    <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush