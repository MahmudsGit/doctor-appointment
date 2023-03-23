<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctor.index', [
            'doctors' => Doctor::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create', [
            'departments' => Department::all()
        ]);
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
            'department_id' =>'required|integer',
            'name' =>'required',
            'phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fee' =>'required|integer|min:0'
        ]);

        $doctor = new Doctor();
        $doctor->department_id = $request->department_id;
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->fee = $request->fee;
        $doctor->save();

        Toastr::success('Doctor Added Successfully','Success');

        return redirect()->route('doctor.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Doctor.show', [
            'doctor' => Doctor::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('doctor.edit', [
            'doctor' => Doctor::find($id),
            'departments' => Department::all()
        ]);
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
            'department_id' =>'required|integer',
            'name' =>'required',
            'phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fee' =>'required|integer|min:0'
        ]);
        
        $doctor = Doctor::find($id);
        $doctor->department_id = $request->department_id;
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->fee = $request->fee;
        $doctor->save();
 
        Toastr::success('Doctor Info updated Successfully','Success');

        return redirect()->route('doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();

        
        Toastr::success('Doctor Remove Successfully','Success');
        
        return redirect()->route('doctor.index');
    }
}
