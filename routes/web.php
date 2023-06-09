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

Route::get('appointment/', [\App\Http\Controllers\Appointment\AppointmentController::class, 'index'])->name('appointment.index');
Route::get('appointment/create', [\App\Http\Controllers\Appointment\AppointmentController::class, 'create'])->name('appointment.create');
Route::post('appointment', [\App\Http\Controllers\Appointment\AppointmentController::class, 'store'])->name('appointment.store');
Route::post('appointment/add', [\App\Http\Controllers\Appointment\AppointmentController::class, 'addAppointment'])->name('appointment.addAppointment');
Route::get('appointment/remove/{id}', [\App\Http\Controllers\Appointment\AppointmentController::class, 'removeAppointment'])->name('appointment.removeAppointment');
Route::post('appointment/search', [\App\Http\Controllers\Appointment\AppointmentController::class, 'search'])->name('appointment.search');

Route::get('appointment/getdoctors/{id}', [\App\Http\Controllers\Doctor\GetDoctorController::class, 'getDoctors']);
Route::get('appointment/getdoctorfee/{id}', [\App\Http\Controllers\Doctor\GetDoctorController::class, 'getDoctorsFee']);
Route::get('appointment/doctoravailable/{id}/{date}', [\App\Http\Controllers\Doctor\GetDoctorController::class, 'doctorAvailable']);