@extends('layouts.app')

@push('css')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="bg-light col-lg-10 offset-lg-1 pb-4">
            <div class="d-flex justify-content-between p-6 bg-dark hadline-bg mb-4">
                <h4 class="mb-0 text-light">Doctor List </h4>
                <a href="{{ route('doctor.create') }}" class="btn btn-info btn-sm">Create</a>
            </div>
            @if(count($doctors) > 0)

            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>department</th>
                        <th>phone</th>
                        <th>fee</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->department->name }}</td>
                        <td>{{ $doctor->phone }}</td>
                        <td>{{ $doctor->fee }}</td>
                        <td class="d-flex ">
                            <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                            <a href="{{ route('doctor.show', $doctor->id) }}" class="btn btn-info btn-sm mr-2">View</a>
                            <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center text-danger">Currently Non of doctor is Available</h3>
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush