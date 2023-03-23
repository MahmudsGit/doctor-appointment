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
                <div class="bg-white shadow rounded">
                    @if(count($appointments) > 0)

                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Appointment Date</th>
                                <th>Doctor</th>
                                <th>Patient Name</th>
                                <th>Patient Phone</th>
                                <th>Total Fee</th>
                                <th>Paid Amount</th>
                                <th>Appointment No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>{{ $appointment->patient_phone }}</td>
                                <td>{{ $appointment->total_fee }}</td>
                                <td>{{ $appointment->paid_amount }}</td>
                                <td>{{ $appointment->appointment_no }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $appointments->links() }}
                    @else
                        <h3 class="text-center text-danger">Nothing Found !</h3>
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