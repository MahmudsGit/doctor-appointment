<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Appointment\AppointmentController::class, 'index']);
Route::resource('doctor', \App\Http\Controllers\Doctor\DoctorController::class);

Route::resource('appointment', \App\Http\Controllers\Appointment\AppointmentController::class );
Route::post('appointment/add', [\App\Http\Controllers\Appointment\AppointmentController::class, 'addAppointment'])->name('appointment.addAppointment');
Route::get('appointment/remove/{id}', [\App\Http\Controllers\Appointment\AppointmentController::class, 'removeAppointment'])->name('appointment.removeAppointment');

Route::get('appointment/getdoctors/{id}', [\App\Http\Controllers\Doctor\GetDoctorController::class, 'getDoctors']);
Route::get('appointment/getdoctorfee/{id}', [\App\Http\Controllers\Doctor\GetDoctorController::class, 'getDoctorsFee']);
Route::get('appointment/doctoravailable/{id}/{date}', [\App\Http\Controllers\Doctor\GetDoctorController::class, 'doctorAvailable']);