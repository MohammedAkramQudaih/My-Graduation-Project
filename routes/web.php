<?php

use App\Http\Controllers\ADMIN\AdminController;
use App\Http\Controllers\ADMIN\DashboardController;
use App\Http\Controllers\ADMIN\DoctorController;
use App\Http\Controllers\ADMIN\PatientController;
use App\Http\Controllers\ADMIN\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin',[DashboardController::class,'index'])->name('admin.index');

Route::get('admin/users/index',[UserController::class,'index'])->name('admin.users.list');
// Route::get('admin/users/create',[UserController::class,'create'])->name('admin.user.create');
// Route::post('admin/users/store',[UserController::class,'store'])->name('admin.users.store');
// Route::get('admin/users/edit/{user}',[UserController::class,'edit'])->name('admin.user.edit');
// Route::post('admin/users/update/{user}',[UserController::class,'update'])->name('admin.user.update');
// Route::post('admin/users/destroy/{user}',[UserController::class,'destroy'])->name('admin.user.destroy');
// Route::post('admin/users/restore/{user}',[UserController::class,'restore'])->name('admin.user.restore'); 



Route::get('admin/patients/index',[PatientController::class,'index'])->name('admin.patients.list');
Route::get('admin/patients/create',[PatientController::class,'create'])->name('admin.patient.create');
Route::post('admin/patients/store',[PatientController::class,'store'])->name('admin.patient.store');
Route::get('admin/patients/edit/{patient}',[PatientController::class,'edit'])->name('admin.patient.edit');
Route::post('admin/patients/update/{patient}',[PatientController::class,'update'])->name('admin.patient.update');
Route::post('admin/patients/destroy/{patient}',[PatientController::class,'destroy'])->name('admin.patient.destroy');
Route::post('admin/patients/restore/{patient}',[PatientController::class,'restore'])->name('admin.patient.restore'); 

Route::get('admin/patients/patientBiography/{patient}',[PatientController::class,'patientBiography'])->name('admin.patient.patientBiography');
Route::get('admin/patients/measurements/{patient}',[PatientController::class,'measurements'])->name('admin.patient.measurements');
Route::get('admin/patients/appointments/{patient}',[PatientController::class,'appointments'])->name('admin.patient.appointments');
Route::get('admin/patients/attachments/{patient}',[PatientController::class,'attachments'])->name('admin.patient.attachments');
// Route::get('admin/patients/doctors/{patient}',[PatientController::class,'doctors'])->name('admin.patient.doctors');
Route::get('admin/patients/reviews/{patient}',[PatientController::class,'reviews'])->name('admin.patient.reviews');



Route::get('admin/doctors/index',[DoctorController::class,'index'])->name('admin.doctors.list');
Route::get('admin/doctors/create',[DoctorController::class,'create'])->name('admin.doctor.create');
Route::post('admin/doctors/store',[DoctorController::class,'store'])->name('admin.doctor.store');
Route::get('admin/doctors/edit/{doctor}',[DoctorController::class,'edit'])->name('admin.doctor.edit');
Route::post('admin/doctors/update/{doctor}',[DoctorController::class,'update'])->name('admin.doctor.update');
Route::post('admin/doctors/destroy/{doctor}',[DoctorController::class,'destroy'])->name('admin.doctor.destroy');
Route::post('admin/doctors/restore/{doctor}',[DoctorController::class,'restore'])->name('admin.doctor.restore'); 

Route::get('admin/doctors/patientBiographies/{doctor}',[DoctorController::class,'patientBiographies'])->name('admin.doctor.patientBiographies');
Route::get('admin/doctors/workHours/{doctor}',[DoctorController::class,'workHours'])->name('admin.doctor.workHours');
Route::get('admin/doctors/appointments/{doctor}',[DoctorController::class,'appointments'])->name('admin.doctor.appointments');
// Route::get('admin/doctors/patients/{doctor}',[DoctorController::class,'patients'])->name('admin.doctor.patients');
Route::get('admin/doctors/reviews/{doctor}',[DoctorController::class,'reviews'])->name('admin.doctor.reviews');


Route::get('admin/admins/index',[AdminController::class,'index'])->name('admins.list');
Route::get('admin/admins/create',[AdminController::class,'create'])->name('admin.create');
Route::post('admin/admins/store',[AdminController::class,'store'])->name('admin.store');
Route::get('admin/admins/edit/{admin}',[AdminController::class,'edit'])->name('admin.edit');
Route::post('admin/admins/update/{admin}',[AdminController::class,'update'])->name('admin.update');
Route::post('admin/admins/destroy/{admin}',[AdminController::class,'destroy'])->name('admin.destroy');
Route::post('admin/admins/restore/{admin}',[AdminController::class,'restore'])->name('admin.restore'); 