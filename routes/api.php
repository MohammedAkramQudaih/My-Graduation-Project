<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('patient/register',[AuthController::class,'registerPatient'])->name('patient.register');
Route::post('patient/login',[AuthController::class,'loginPatient'])->name('patient.login');

Route::post('doctor/register',[AuthController::class,'registerDoctor'])->name('doctor.register');
Route::post('doctor/login',[AuthController::class,'loginDoctor'])->name('doctor.login');


Route::get('logout/',[AuthController::class,'logout'])->name('logout')->middleware('auth:sanctum');


Route::get('patient/profile', [PatientController::class,'profile'])->middleware('auth:sanctum');


// Route::post('changeName', [PatientController::class,'changeName'])->name('changeName')->middleware('auth:sanctum');
// Route::post('changePassword', [PatientController::class,'changePassword'])->name('changePassword')->middleware('auth:sanctum');

Route::post('patient/updateProfile',[PatientController::class, 'updateProfile'])->name('updateProfile')->middleware('auth:sanctum');

Route::get('patient/medicalData',[PatientController::class, 'medicalData'])->name('medicalData')->middleware('auth:sanctum');
Route::post('patient/storeAttachments',[PatientController::class, 'storeAttachments'])->name('storeAttachments')->middleware('auth:sanctum');
Route::post('patient/deleteAttachments/{attachment}',[PatientController::class, 'deleteAttachments'])->name('deleteAttachments')->middleware('auth:sanctum');
Route::get('patient/patientBiographies',[PatientController::class, 'patientBiographies'])->name('patientBiographies')->middleware('auth:sanctum');
Route::get('patient/doctors',[PatientController::class, 'doctors'])->name('doctors')->middleware('auth:sanctum');
Route::post('patient/ratingDoctor/{doctor}',[PatientController::class, 'ratingDoctor'])->name('ratingDoctor')->middleware('auth:sanctum');
Route::post('patient/appointmentBooking/{doctor}',[PatientController::class, 'appointmentBooking'])->name('appointmentBooking')->middleware('auth:sanctum');
Route::get('patient/showAppointments',[PatientController::class, 'showAppointments'])->name('showAppointments')->middleware('auth:sanctum');
Route::post('patient/storeMeasurement',[PatientController::class, 'storeMeasurement'])->name('storeMeasurement')->middleware('auth:sanctum');
Route::get('patient/showMeasurements',[PatientController::class, 'showMeasurements'])->name('showMeasurements')->middleware('auth:sanctum');

Route::get('patient/searchDoctors', [PatientController::class, 'searchDoctors'])->name('searchDoctors')->middleware('auth:sanctum');
Route::get('patient/doctorProfile/{doctor}', [PatientController::class, 'doctorProfile'])->name('doctorProfile')->middleware('auth:sanctum');



Route::post('forgetPassword', [AuthController::class,'sendResetLinkEmail'])->name('forgetPassword');
Route::post('resetPassword', [AuthController::class,'resetPassword'])->name('password.reset');



/** Doctor Routes */

Route::get('doctor/profile', [DoctorController::class,'profile'])->name('doctor.profile')->middleware('auth:sanctum');
Route::get('doctor/showAllBookedAppointments', [DoctorController::class,'showAllBookedAppointments'])->name('doctor.showAllBookedAppointments')->middleware('auth:sanctum');
Route::post('doctor/updateAppointment/{appointment}', [DoctorController::class,'updateAppointment'])->name('doctor.updateAppointment')->middleware('auth:sanctum');
Route::get('doctor/allPatients', [DoctorController::class,'allPatients'])->name('doctor.allPatients')->middleware('auth:sanctum');
Route::get('doctor/patientProfile/{patient}', [DoctorController::class,'patientProfile'])->name('doctor.patientProfile')->middleware('auth:sanctum');
Route::post('doctor/addPatientBiography/{patient}', [DoctorController::class,'addPatientBiography'])->name('doctor.addPatientBiography')->middleware('auth:sanctum');
Route::post('doctor/addReview/{patient}', [DoctorController::class,'addReview'])->name('doctor.addReview')->middleware('auth:sanctum');
// Route::get('doctor/updateAppointment', [DoctorController::class,'updateAppointment']);

