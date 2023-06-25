<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DoctorController extends Controller
{
    //

    public function profile(Request $request)
    {
        $user = $request->user();
        $doctor = Doctor::with('workHours')->where('user_id', $user->id)->first();
        // return $patient;

        // return Response::json([
        //     'code' => 200,
        //     'messag' => 'Dr. ' . $doctor->name . '`s profile',  //Dr. Mohamed's data
        //     'data' => $doctor
        // ]);

        if ($doctor) {
            return response()->json([
                'code' => 200,
                'message' => 'Dr. ' . $doctor->name . '\'s profile',
                'data' => $doctor,
            ]);
        }

        return response()->json([
            'code' => 404,
            'message' => 'Doctor not found',
            'data' => [],
        ]);
    }

    public function showAllBookedAppointments(Request $request)
    {

        $user = $request->user();
        $doctor = Doctor::with('appointments')->where('user_id', $user->id)->first();
        // return $doctor->appointments ;

        return Response::json([
            'code' => 200,
            'message' => 'all booked appointments for Dr. ' . $doctor->name,
            'data' => $doctor->appointments,
        ]);
    }

    public function updateAppointment(Request $request, $id)
    {
        // return 'hi';
        $user = $request->user();
        $doctor = Doctor::with('appointments')->with('patients')->where('user_id', $user->id)->first();
        $appointment =  $doctor->appointments->find($id);
        // return $doctor->patients;

        // return $request->status;
        if ($appointment) {
            if ($request->status == 'confirmed') {
                $doctor->patients()->attach([$appointment->patient_id,]);
            }
            $appointment->update($request->all());

            return Response::json([
                'code' => 200,
                'message' => 'Appointment updated succesfully',
                'data' => $appointment,
            ]);
        }

        return Response::json([
            'code' => 404,
            'message' => 'Appointment not found',
            'data' => [],
        ]);

        // $appointment = Appointment::where('doctor_id', $doctor->id)->where('id',$id)->get();
        // return $appointment;

    }

    public function allPatients(Request $request)
    {
        $user = $request->user();
        $doctor = Doctor::with('patients')->where('user_id', $user->id)->first();
        // return $patients = $doctor->patients;

        if ($doctor) {
            $patients = $doctor->patients;

            return response()->json([
                'code' => 200,
                'message' => 'Patients associated with Dr. ' . $doctor->name,
                'data' => $patients,
            ]);
        }

        return response()->json([
            'code' => 404,
            'message' => 'Doctor not found',
            'data' => [],
        ]);
    }

    public function patientProfile(Request $request, $id)
    {
        $user = $request->user();
        $doctor = Doctor::with('patients')->where('user_id', $user->id)->first();

        if ($doctor) {
            $patient = $doctor->patients->find($id);

            if ($patient) {
                $patientOpj = Patient::with('patientBiography', 'measurements', 'appointments', 'attachments', 'reviews', 'doctors')->where('id', $patient->id)->first();
                return response()->json([
                    'code' => 200,
                    'message' => 'Patient profile for patient ID: ' . $id,
                    'data' => $patientOpj
                ]);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'Patient not found',
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Doctor not found',
                'data' => []
            ]);
        }
    }

    public function addPatientBiography(Request $request, $id)
    {
        $user = $request->user();
        $doctor = Doctor::with('patients')->where('user_id', $user->id)->first();
    
        if ($doctor) {
            $patient = $doctor->patients->find($id);
    
            if ($patient) {
                $patientBiography = $doctor->patientBiographies()->create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctor->id,
                    'diagnostics' => $request->diagnostics,
                    'medications' => $request->medications
                ]);
    
                return response()->json([
                    'code' => 200,
                    'message' => 'Patient biography created successfully',
                    'data' => $patientBiography
                ]);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'Patient not found',
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Doctor not found',
                'data' => []
            ]);
        }
    }
    
}
