<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\WorkHour;
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


    public function addReview(Request $request, $id)
    {
        $user = $request->user();
        $doctor = Doctor::with('patients')->where('user_id', $user->id)->first();

        if ($doctor) {
            $patient = $doctor->patients->find($id);

            if ($patient) {
                $review = $doctor->reviews()->create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctor->id,
                    'review_day' => $request->review_day,
                    'review_date' => $request->review_date,
                    'review_time' => $request->review_time,
                ]);

                return response()->json([
                    'code' => 200,
                    'message' => 'Review created successfully',
                    'data' => $review
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

    // public function addWorkHours(Request $request)
    // {
    //     $user = $request->user();
    //     $doctor = Doctor::with('workHours')->where('user_id', $user->id)->first();

    //     // return $doctor;
    //     $request->validate([
    //         'day' => ['required'],
    //         'start_time' => ['required'],
    //         'end_time' => ['required'],

    //     ]);


    //     $workHours = $doctor->workHours()->create([
    //         'doctor_id' => $doctor->id,
    //         'day' => $request->day,
    //         'start_time' => $request->start_time,
    //         'end_time' => $request->end_time,
    //     ]);
    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'Review created successfully',
    //         'data' => $workHours
    //     ]);
    // }
    public function addWorkHours(Request $request)
    {
        $user = $request->user();
        $doctor = Doctor::with('workHours')->where('user_id', $user->id)->first();

        $request->validate([
            'day' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        // Check if work hours already exist for the specified day and time
        $existingWorkHours = $doctor->workHours()
            ->where('day', $request->day)
            ->where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->exists();

        if ($existingWorkHours) {
            return response()->json([
                'code' => 409,
                'message' => 'Work hours already exist for the specified day and time',
                'data' => []
            ]);
        }

        $workHours = $doctor->workHours()->create([
            'doctor_id' => $doctor->id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Work hours created successfully',
            'data' => $workHours
        ]);
    }

    public function editWorkHours(Request $request, $id)
    {
        $user = $request->user();
        $doctor = Doctor::with('workHours')->where('user_id', $user->id)->first();

        $request->validate([
            'day' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        $workHours = WorkHour::findOrFail($id);

        // Check if the work hours belong to the requesting doctor
        if ($workHours->doctor_id !== $doctor->id) {
            return response()->json([
                'code' => 403,
                'message' => 'Unauthorized to edit the work hours',
                'data' => []
            ]);
        }

        // Check if work hours already exist for the specified day and time
        $existingWorkHours = $doctor->workHours()
            ->where('day', $request->day)
            ->where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->where('id', '!=', $id)
            ->exists();

        if ($existingWorkHours) {
            return response()->json([
                'code' => 409,
                'message' => 'Work hours already exist for the specified day and time',
                'data' => []
            ]);
        }

        $workHours->update([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Work hours updated successfully',
            'data' => $workHours
        ]);
    }

    public function deleteWorkHours(Request $request, $id)
    {
        $user = $request->user();
        $doctor = Doctor::with('workHours')->where('user_id', $user->id)->first();

        $workHours = WorkHour::findOrFail($id);

        // Check if the work hours belong to the requesting doctor
        if ($workHours->doctor_id !== $doctor->id) {
            return response()->json([
                'code' => 403,
                'message' => 'Unauthorized to delete the work hours',
                'data' => []
            ]);
        }

        $workHours->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Work hours deleted successfully',
            'data' => []
        ]);
    }

    public function searchPatients(Request $request)
    {
        $query = $request->input('query');
        $user = $request->user();
        $doctor = Doctor::with('patients')->where('user_id', $user->id)->first();

        if ($doctor) {
            $patients = $doctor->patients;

            $results = $patients->filter(function ($patient) use ($query) {
                return stripos($patient->name, $query) !== false;
            });


            return response()->json([
                'code' => 200,
                'message' => 'Patients search results',
                'data' => $results
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Doctor not found',
                'data' => []
            ]);
        }
    }
}
