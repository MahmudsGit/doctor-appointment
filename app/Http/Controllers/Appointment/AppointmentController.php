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
            'appointments' => Appointment::orderBy('created_at', 'desc')->paginate('10')
        ]);
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'search' =>'required',
            'category' =>'required',
        ]);

        if($request->category == 'appointment_date'){
            $appointments = Appointment::where('appointment_date', 'LIKE', "%$request->search%")->paginate('10');
        }

        if($request->category == 'doctor_id'){

            $doctor = Doctor::where('name', $request->search)->get();

            foreach($doctor as $info){
                $doctor_id = $info->id;
            }

            $appointments = Appointment::where('doctor_id', 'LIKE', "%$doctor_id%")->paginate('10');
        }

        if($request->category == 'patient_name'){
            $appointments = Appointment::where('patient_name', 'LIKE', "%$request->search%")->paginate('10');
        }

        if($request->category == 'patient_phone'){
            $appointments = Appointment::where('patient_phone', 'LIKE', "%$request->search%")->paginate('10');
        }

        if($request->category == 'appointment_no'){
            $appointments = Appointment::where('appointment_no', 'LIKE', "%$request->search%")->paginate('10');
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
        // Session::flush();

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

            for($i = 0 ; $i <= count($allAppointment); $i++){
                if($allAppointment[$i]['doctor_id'] == $appointment['doctor_id'] && $allAppointment[$i]['appointment_date'] == $appointment['appointment_date']){
                
                    return redirect()->route('appointment.create');
                }else{
                    array_push($allAppointment, $appointment);
                    $request->session()->put('allAppointment', $allAppointment);
                }
            }

        }else{
            $allAppointment[0] = $appointment;
            $request->session()->put('allAppointment', $allAppointment);
        }


        // $total_fee = array_sum($allAppointment['fee']);
        // $total_fees = [];
        // foreach($allAppointment as $index=>$item){
        //     // $total_fee = array_sum($item['fee']);
        //     $total_fee = $index['fee'];
        // }
        // dd($total_fee);

        // $request->session()->put('total_fee', $total_fee);

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
        
        for($i = 0 ; $i < count(session()->get('allAppointment')) ; $i++){
            $total_fee = session()->get('allAppointment')[$i]['fee'];
        }

        $current_Date = Carbon::now()->format('d_m_Y');

        for($i = 0 ; $i < count(session()->get('allAppointment')) ; $i++){
            $appointment = new Appointment();
            $appointment->appointment_date = session()->get('allAppointment')[$i]['appointment_date'];
            $appointment->doctor_id = session()->get('allAppointment')[$i]['doctor_id'];
            $appointment->patient_name = $request->patient_name;
            $appointment->patient_phone = $request->patient_phone;
            $appointment->total_fee = 123;
            $appointment->paid_amount = $request->paid_amount;
            $appointment->appointment_no = 1212;
            $appointment->save();
        }

        Session::flush();
        
        Toastr::success('Appointment Success','Success');
        return redirect()->route('appointment.index')->with('alert-green', 'Appointment Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'appointment_date' =>'required',
            'doctor_id' =>'required|integer',
            'patient_name' =>'required',
            'patient_phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'total_fee' =>'required|integer|min:0',
            'paid_amount' =>'required|integer|min:0'
        ]);
        
        $appointment = Appointment::find($id);
        $appointment->appointment_date = $request->appointment_date;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->patient_name = $request->patient_name;
        $appointment->patient_phone = $request->patient_phone;
        $appointment->total_fee = $request->total_fee;
        $appointment->paid_amount = $request->paid_amount;
        $appointment->appointment_no = $request->appointment_no;
        $appointment->save();
 
        return redirect()->route('appointment.index')->with('alert-green', 'Doctor Info updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->route('appointment.index')->with('alert-green', 'Appointment Delete Successfully');
    }
}
