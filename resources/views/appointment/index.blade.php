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