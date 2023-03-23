@extends('layouts.app')

@push('css')
@endpush

@section('content')
<div class="appointment-page bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between p-6 bg-dark hadline-bg mb-4">
                    <h4 class="mb-0 text-light">Appointment List </h4>
                    <form class="d-flex rounded bg-white " action="{{ route('appointment.search') }}" method="POST">
                        @csrf
                        <select name="category" class="select rounded border-0" data-mdb-filter="true">
                            <option value="appointment_date">Appointment Date</option>
                            <option value="doctor_id">Doctor Name</option>
                            <option value="patient_name">Patient Name</option>
                            <option value="patient_phone">Patient Phone</option>
                            <option value="appointment_no">Appointment No</option>
                        </select>
                        <input type="search" name="search" class="form-control rounded-0 border-end-0" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <button class="input-group-text rounded-start-0 border-0" id="search-addon">Search</button>
                    </form>
                    <a href="{{ route('appointment.create') }}" class="btn btn-info">Get Apponment</a>
                </div>
                <div class="bg-white shadow rounded p-4">

                    @if(count($appointments) > 0)
                    
                    <?php $i = 1 ?>
                    @foreach($appointments as $appointment)
                    <div class="card mb-3" style="width: 100%;">
                        <div class="row g-0">
                          <div class="col-md-2 ">
                            <div class="d-flex justify-content-center align-self-center bg-dark number-icon rounded-start" >
                                <p class="bg-info rounded-bottom number-icon-text">{{ $i++ }}</p>
                            </div>
                          </div>
                          <div class="col-md-10">
                            <div class="card-body">
                              <h5 class="card-title">Appointment Information</h5>
                              <p class="fs-6 m-0 p-0"><span class="fw-bold">Appointment No: </span> {{ $appointment->appointment_no }}</p>
                              <p class="fs-6 m-0 p-0"><span class="fw-bold">Patient Name: </span> {{ $appointment->patient_name }}</p>
                              <p class="fs-6 m-0 p-0"><span class="fw-bold">Patient Phone: </span> {{ $appointment->patient_phone }}</p>
                              <p class="fs-6 m-0 p-0"><span class="fw-bold">Doctor Name: </span> {{ $appointment->doctor->name }}</p>
                              <p class="fs-6 m-0 p-0"><span class="fw-bold">Appointment Date: </span> 
                                <small class="text-muted">{{ $appointment->appointment_date }}</small>
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>

                    @endforeach
                    
                    {{ $appointments->links() }}

                    @else
                        <h3 class="text-center text-danger">Currently Non of appointment is Available</h3>
                    @endif
                </div>
                <p class="text-end text-secondary mt-3">Submited By Md Golam Mahmud</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush