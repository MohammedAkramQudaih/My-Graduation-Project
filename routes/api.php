<?php

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


Route::post('register',[PatientController::class,'register'])->name('register');
Route::post('login',[PatientController::class,'login'])->name('login');
Route::get('logout',[PatientController::class,'logout'])->name('logout')->middleware('auth:sanctum');
Route::get('profile', [PatientController::class,'profile'])->middleware('auth:sanctum');


// Route::post('changeName', [PatientController::class,'changeName'])->name('changeName')->middleware('auth:sanctum');
// Route::post('changePassword', [PatientController::class,'changePassword'])->name('changePassword')->middleware('auth:sanctum');

Route::post('updateProfile',[PatientController::class, 'updateProfile'])->name('updateProfile')->middleware('auth:sanctum');
Route::get('medicalData',[PatientController::class, 'medicalData'])->name('medicalData')->middleware('auth:sanctum');
Route::post('storeAttachments',[PatientController::class, 'storeAttachments'])->name('storeAttachments')->middleware('auth:sanctum');
Route::post('deleteAttachments/{attachment}',[PatientController::class, 'deleteAttachments'])->name('deleteAttachments')->middleware('auth:sanctum');

