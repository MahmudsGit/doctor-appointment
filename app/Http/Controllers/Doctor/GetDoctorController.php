<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class GetDoctorController extends Controller
{
    public function getDoctors($id)
    {
        echo json_encode(Doctor::where('department_id', $id)->get());
    }

    public function getDoctorsFee($id)
    {
        echo json_encode(Doctor::where('id', $id)->get());
    }
    
    public function doctorAvailable($id, $date)
    {
        echo json_encode( count(Appointment::where('doctor_id', $id)->where('appointment_date', '=', $date)->get()) );
    }
}
