@extends('layouts.app')

@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="bg-light">
                    <div class="row">
                        <div class="col-md-6 pe-0 bg-left">
                            <div class="form-left h-100 py-5 px-5">
                                <div class="d-flex flex-column align-items-center">
                                    <form class="appointment-form" action="{{ route('appointment.addAppointment') }}" method="POST">
                                        @csrf
                                        <div class="mb-3 date" >
                                            <label for="appointment_date" class="form-label fw-bold">Appointment Date</label>
                                            <input type="date" name="appointment_date" class="form-control" id="appointment_date" placeholder="mm/dd/yyyy">
                                        </div>
                                        <div class="mb-3">
                                            <label for="department_id" class="form-label fw-bold">Select Department</label>
                                            <select name="department_id" class="form-control" id="select_department">
                                                <option value="0" disabled selected>-- Select --</option>
                                                @if(count($departments) > 0)
                                                @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                                
                                                @else
                                                <option value="">None</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label for="doctor_id" class="form-label fw-bold">Select Doctor</label>
                                            <select name="doctor_id" class="form-control" id="select_doctor">
                                                
                                            </select>
                                        </div>
                                        <p id="availabletext" class="text-success fw-bold">Availability</p>
                                        <input type="text" name="available" class="form-control" id="available" hidden>
                                        <div class="mb-3">
                                            <label for="fee" class="form-label fw-bold">Fee</label>
                                            <input type="text" name="fee" class="form-control" id="fee" readonly>
                                        </div>
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-right text-white">
                                <div class="appointment-wrapper mb-4 pt-4">
                                    @if ( session()->get('allAppointment') )
                                    <table class="table table-bordered table-sm border-light text-light">
                                        <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>App. Date</th>
                                            <th>Doctor</th>
                                            <th>Fee</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            @foreach (session()->get('allAppointment') as $index => $appt)                                            
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    {{ $appt['appointment_date'] }}
                                                </td>
                                                <td>
                                                    @foreach ($doctors as $doctor)
                                                        {{ $appt['doctor_id'] == $doctor->id ? $doctor->name : '' }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $appt['fee'] }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('appointment.removeAppointment', $index ) }} " class="fs-5 text-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                                                                    
                                        </tbody>
                                    </table>
                                    @endif
                                    
                                </div>
                                <div class="appointment-wrapper d-flex justify-content-center align-items-start ">
                                    
                                  <form class="appointment-form bg-light p-4" action="{{ route('appointment.store') }}" method="POST">
                                        @csrf
                                        <p for="patient_info" class="form-label text-dark fw-bold">Patient Information</p>
                                        <div class="d-flex justify-content-between gap-4">
                                            <div class="mb-3">
                                                <input type="text" name="patient_name" class="form-control" id="patient_name" placeholder="Patient Name">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="patient_phone" class="form-control" id="patient_phone" placeholder="Patient Phone">
                                            </div>
                                        </div>
                                        <p for="payment" class="form-label text-dark fw-bold">Payment</p>
                                        <div class="d-flex justify-content-between gap-4">
                                            <div class="mb-3">
                                                <input type="text" name="total_fee" class="form-control" id="total_fee" placeholder="Total Fee" value="{{ session()->get('total_fee') }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="paid_amount" class="form-control" id="paid_amount" placeholder="Patient Amount">
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/create.js') }}"></script>
@endpush