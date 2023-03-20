<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Doctor.index', [
            'doctors' => Doctor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Doctor.create');
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
            'department_id' =>'required',
            'name' =>'required',
            'phone' =>'required|',
            'fee' =>'required|integer',
         ]);
 
         $doctor = new Doctor();
         $doctor->department_id = $request->department_id;
         $doctor->name = $request->name;
         $doctor->phone = $request->phone;
         $doctor->fee = $request->fee;
         $doctor->save();
 
         return redirect()->route('Doctor.create')->with('alert-green', 'New Doctor Added Successfully');
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
        return view('Doctor.edit', [
            'doctor' => Doctor::find($id)
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
            'department_id' =>'required',
            'name' =>'required',
            'phone' =>'required|',
            'fee' =>'required|integer',
        ]);
 
        $doctor = Doctor::find($id);
        $doctor->department_id = $request->department_id;
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->fee = $request->fee;
        $doctor->save();
 
        return redirect()->route('Doctor.edit')->with('alert-green', 'Doctor Info updated Successfully');
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
        return redirect()->back()->with('alert-green', 'Doctor Delete Successfully');
    }
}
