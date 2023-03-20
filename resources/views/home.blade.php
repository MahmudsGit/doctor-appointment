@extends('layouts.app')

@push('css')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="bg-light col-lg-10 offset-lg-1">
            <div class="d-flex justify-content-between p-6 bg-dark hadline-bg mb-4">
                <h4 class="mb-0 text-light">Appointment List </h4>
                <a href="{{ route('doctor.create') }}" class="btn btn-info">Get Apponment</a>
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush