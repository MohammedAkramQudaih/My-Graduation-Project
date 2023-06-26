<?php

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

Route::get('index',[DashboardController::class,'index'])->name('admin.index');

// Route::resource('admin/users', UserController::class)->names([
//     'index' => 'admin.users.list',
//     'create' => 'admin.user.create',
//     'store' => 'admin.user.store',
//     'show' => 'admin.user.show',
//     'edit' => 'admin.user.edit',
//     'update' => 'admin.user.update',
//     'destroy' => 'admin.user.destroy',
// ])->middleware('auth', RoleMiddleware::class . ':admin');
// Route::post('admin/users/restore/{user}',[UserController::class,'restore'])->name('admin.user.restore')->middleware('auth', RoleMiddleware::class . ':admin'); 


Route::get('admin/users/index',[UserController::class,'index'])->name('admin.users.list');
// Route::get('admin/users/create',[UserController::class,'create'])->name('admin.user.create');
// Route::post('admin/users/store',[UserController::class,'store'])->name('admin.users.store');
Route::get('admin/users/edit/{user}',[UserController::class,'edit'])->name('admin.user.edit');
Route::post('admin/users/update/{user}',[UserController::class,'update'])->name('admin.user.update');
Route::post('admin/users/destroy/{user}',[UserController::class,'destroy'])->name('admin.user.destroy');
Route::post('admin/users/restore/{user}',[UserController::class,'restore'])->name('admin.user.restore'); 



Route::get('admin/patients/index',[PatientController::class,'index'])->name('admin.patients.list');
Route::get('admin/patients/create',[PatientController::class,'create'])->name('admin.patient.create');
Route::post('admin/patients/store',[PatientController::class,'store'])->name('admin.patient.store');
Route::get('admin/patients/edit/{patient}',[PatientController::class,'edit'])->name('admin.patient.edit');
Route::post('admin/patients/update/{patient}',[PatientController::class,'update'])->name('admin.patient.update');
Route::post('admin/patients/destroy/{patient}',[PatientController::class,'destroy'])->name('admin.patient.destroy');
Route::post('admin/patients/restore/{patient}',[PatientController::class,'restore'])->name('admin.patient.restore'); 



Route::get('admin/doctors/index',[DoctorController::class,'index'])->name('admin.doctors.list');
Route::get('admin/doctors/create',[DoctorController::class,'create'])->name('admin.doctor.create');
Route::post('admin/doctors/store',[DoctorController::class,'store'])->name('admin.doctor.store');
Route::get('admin/doctors/edit/{doctor}',[DoctorController::class,'edit'])->name('admin.doctor.edit');
Route::post('admin/doctors/update/{doctor}',[DoctorController::class,'update'])->name('admin.doctor.update');
Route::post('admin/doctors/destroy/{doctor}',[DoctorController::class,'destroy'])->name('admin.doctor.destroy');
Route::post('admin/doctors/restore/{doctor}',[DoctorController::class,'restore'])->name('admin.doctor.restore'); 
