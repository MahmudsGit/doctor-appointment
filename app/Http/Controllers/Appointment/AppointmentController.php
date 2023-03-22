<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointment.index', [
            'appointments' => Appointment::orderBy('created_at', 'desc')->paginate('5')
        ]);
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'search' =>'required',
            'category' =>'required',
        ]);

        if($request->category == 'appointment_date'){
            $appointments = Appointment::where('appointment_date', 'LIKE', "%$request->search%")->paginate('5');
        }

        if($request->category == 'doctor_id'){

            $doctor = Doctor::where('name', $request->search)->get();

            foreach($doctor as $info){
                $doctor_id = $info->id;
            }

            $appointments = Appointment::where('doctor_id', 'LIKE', "%$doctor_id%")->paginate('5');
        }

        if($request->category == 'patient_name'){
            $appointments = Appointment::where('patient_name', 'LIKE', "%$request->search%")->paginate('5');
        }

        if($request->category == 'patient_phone'){
            $appointments = Appointment::where('patient_phone', 'LIKE', "%$request->search%")->paginate('5');
        }

        if($request->category == 'appointment_no'){
            $appointments = Appointment::where('appointment_no', 'LIKE', "%$request->search%")->paginate('5');
        }

        return view('appointment.search', [
            'appointments' => $appointments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('appointment.create', [
            'appointments' => Appointment::all(),
            'departments' => Department::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addAppointment(Request $request)
    {        
        $this->validate($request,[
            'appointment_date' =>'required',
            'doctor_id' =>'required|integer',
        ]);

        $appointment = [];
        $allAppointment = [];
    
        $appointment['appointment_date'] = $request->appointment_date;
        $appointment['doctor_id'] = $request->doctor_id;
        $appointment['fee'] = $request->fee;

        if(session()->has('allAppointment') && count(Session::get('allAppointment')) > 0){
            $allAppointment = Session::get('allAppointment');

            if (Appointment::where('appointment_date', '=', $request->appointment_date)->count() > 2) {

                    Toastr::success('Doctor Is Not Available !','Warning');
                    return redirect()->route('appointment.create');
             }else{
                    array_push($allAppointment, $appointment);
                    $request->session()->put('allAppointment', $allAppointment);
            }
        }else{
            $allAppointment[0] = $appointment;
            $request->session()->put('allAppointment', $allAppointment);
        }

        $total_fees = [];
        foreach(Session::get('allAppointment') as $index => $appt){
            array_push($total_fees, $appt['fee']);
        }

        $total_fee = array_sum($total_fees);
        $request->session()->put('total_fee', $total_fee);

        Toastr::success('Appointment Listed Success','Success');
        return redirect()->route('appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeAppointment($id)
    {        
        $apptSession = session()->get("allAppointment");

        foreach($apptSession as $index => $appt){
          if($index == $id){
            unset($apptSession[$index]);
          }
        }

        session()->put("allAppointment", $apptSession);

        $total_fees = [];
        foreach(Session::get('allAppointment') as $index => $appt){
            array_push($total_fees, $appt['fee']);
        }

        $total_fee = array_sum($total_fees);
        session()->put('total_fee', $total_fee);

        Toastr::success('Appointment Listed Item Remove Success','Success');
        return redirect()->route('appointment.create');            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'patient_name' =>'required',
            'patient_phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'paid_amount' =>'required|integer|min:0'
        ]);
        
        $current_Date = Carbon::now()->format('d_m_Y_H_i_s');

        if(session()->get('total_fee') == $request->paid_amount){

            foreach(session()->get('allAppointment') as $index => $appt){
                $appointment = new Appointment();
                $appointment->appointment_date = $appt['appointment_date'];
                $appointment->doctor_id = $appt['doctor_id'];
                $appointment->patient_name = $request->patient_name;
                $appointment->patient_phone = $request->patient_phone;
                $appointment->total_fee = session()->get('total_fee');
                $appointment->paid_amount = $request->paid_amount;
                $appointment->appointment_no = $current_Date.$appointment->id.'_'.Str::random(2);
                $appointment->save();
            }

            Session::flush();
            
            Toastr::success('Appointment Success','Success');
            return redirect()->route('appointment.index');
        }else{

            Toastr::success('Total Amount Miss Match','Warning');
            return redirect()->route('appointment.index');
        }
        
    }
}
