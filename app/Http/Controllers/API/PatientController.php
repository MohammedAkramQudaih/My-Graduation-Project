<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Attachment;
use App\Models\Doctor;
use App\Models\Measurement;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // public function register(Request $request)
    // {
    //     $validator =  Validator::make($request->all(), [
    //         'email' => 'required|email|unique:patients',
    //         'name' => 'required|string',
    //         'password' => ['required'],

    //     ]);
    //     if ($validator->fails()) {


    //         return Response::json([
    //             'code' => 401,
    //             'message' => 'registration failed',
    //             'data' => $validator->messages(),
    //         ]);
    //     } else {

    //         $name = $request->name;
    //         $email = $request->email;
    //         $password = $request->password;

    //         $patient = Patient::create([
    //             'name' => $name,
    //             'email' => $email,
    //             'password' => Hash::make($password)
    //         ]);

    //         User::create([
    //             'name' => $patient->name,
    //             'email' => $patient->email,
    //             'password' => $patient->password,
    //             'role' => 'patient'

    //         ]);
    //         return Response::json([
    //             'code' => 201,
    //             'message' => 'successfully registered',
    //             'data' => $patient,
    //         ]);
    //     }
    // }
    // public function login(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [

    //         'email' => 'required|email',
    //         'password' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return Response::json([
    //             'code' => 401,
    //             'message' => $validator->errors()->all(),
    //             'data' => []
    //         ]);
    //     }
    //     $patient = User::where('email', $request->email)->where('role', 'patient')->first();
    //     if (!$patient || !Hash::check($request->password, $patient->password)) {
    //         return Response::json([
    //             'code' => 401,
    //             'message' => 'Invalid Credentials',
    //             'data' => []
    //         ]);
    //     }

    //     $token = $patient->createToken('AuthToken')->plainTextToken;


    //     return Response::json([
    //         'code' => 200,
    //         'message' => 'logged in successfully',
    //         'data' => [

    //             'token' => $token,
    //             //                'name' => $patient->name,
    //             //                'email' => $patient->email,
    //         ]
    //     ]);
    // }
    // public function logout(Request $request)
    // {
    //     return 'fkdfdklnjbgn.,';
    // }
    public function profile(Request $request)
    {
        $user = $request->user();
        $patient = Patient::with('patientBiography', 'measurements', 'appointments', 'attachments')->where('user_id', $user->id)->first();
        // return $patient;

        // return response()->json([
        //     'patient' => $patient,
        // ], 200);

        return Response::json([
            'code' => 200,
            'message' => 'patient data',
            'data' =>  $patient

        ]);
    }
    public function index()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        //
        $user = $request->user();
        $patient = Patient::where('user_id', $user->id)->first();
        // return $patient;


        $request->validate([
            'phone_No' => ['numeric'],
            'age' => ['nullable'],
            'image' => ['file'],
            'address' => ['required'],
            'gender' => ['required'],
            'diabetic_type' => ['required']




        ]);
        // $patient->update($request->all());
        $imageName = $patient->image;
        // return  $patient->image;
        $file = $request->file('image');
        // return $file;

        if (!isNull($file)) {
            $ex = $file->getClientOriginalExtension();
            $imageName = 'patientImage' . rand() . time() . '.' . $ex;
            $file->move(public_path('api/patient/image'), $imageName);
        } else {
            $ex = $request->file('image')->getClientOriginalExtension();
            $imageName = 'patientImage' . rand() . time() . '.' . $ex;
            $file->move(public_path('api/patient/image'), $imageName);
        }
        // return $imageName;


        $patient->update([

            'phone_No' => $request->phone_No,
            'age' => $request->age,
            'image' => $imageName,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'diabetic_type' => $request->diabetic_type,


        ]);
        // $patient->update($request->except('image'));
        // $patient->update([
        //     'image' => $imageName,
        // ]);


        return Response::json([
            'code' => 200,
            'message' => 'patient updated successfully',
            'data' =>  $patient

        ]);
    }

    public function storeAttachments(Request $request)
    {
        //
        $user = $request->user();
        $patient = Patient::with('attachments')->where('user_id', $user->id)->first();
        // return $patient;
        $request->validate([
            'attachments' => 'file'
        ]);

        $ex = $request->file('attachment')->getClientOriginalExtension();
        $file_path = 'abc' . rand() . time() . '.' . $ex;
        $request->file('attachment')->move(public_path('api/patient/attachments'), $file_path);

        $attachment = Attachment::create([
            'patient_id' => $patient->id,
            'filename' => $request->fileName,
            'filepath' => $file_path
        ]);

        return Response::json(
            [
                'code' => 200,
                'message' => 'attachment created succesfully',
                'data' => $attachment
            ]

        );
    }

    public function deleteAttachments($id)
    {


        $attachment = Attachment::findOrFail($id);

        $attachment->delete();
        File::delete(public_path('/attachments/' . $attachment->filepath));
        return Response::json([
            'code' => 200,
            'message' => 'Store Deleted Successfully',
            'data' => [],
        ]);
    }

    public function show($id)
    {
        //
    }



    public function patientBiographies(Request $request)
    {
        $user = $request->user();
        $patient = Patient::where('user_id', $user->id)->with('patientBiography')->first();

        if (!$patient) {
            return response()->json([
                'code' => 404,
                'message' => 'Patient not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Patient biography',
            'data' => $patient->patientBiography
        ]);
    }

    public function doctors()
    {

        # code...
        $doctors = Doctor::orderByDesc('rateing')->get();

        return Response::json([
            'code' => 200,
            'messag' => 'all doctors',
            'data' => $doctors
        ]);
    }

    public function ratingDoctor(Request $request, $id)
    {
        # code...
        $doctor = Doctor::findOrFail($id);
        // return $doctor;  
        $rateing = $request->rateing;

        $doctor->update([
            'rateing' => $rateing
        ]);

        return Response::json([
            'code' => 200,
            'messag' => 'the rateing for doctor',
            'data' => $rateing
        ]);
    }

    public function appointmentBooking(Request $request, $id)
    {
        # code...
        // $doctor=Doctor::findOrFail($id);
        $user = $request->user();
        $patient = Patient::where('email', $user->email)->first();

        $request->validate([
            'booking_day' => ['required'],
            'booking_date' => ['required'],
            'booking_time' => ['required'],

        ]);

        $appointment = Appointment::create([
            'doctor_id' => $id,
            'patient_id' => $patient->id,
            'booking_day' => $request->booking_day,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
        ]);

        return Response::json([
            'code' => 200,
            'message' => 'Appointment created succesfully',
            'data' => $appointment,
        ]);
    }

    public function showAppointments(Request $request)
    {
        # code...
        $user = $request->user();
        $patient = Patient::with('appointments')->where('user_id', $user->id)->first();

        return Response::json([
            'code' => 200,
            'message' => 'appointments',
            'data' => $patient->appointments
        ]);
    }

    public function storeMeasurement(Request $request)
    {
        # code...
        $user = $request->user();
        $patient = Patient::where('user_id', $user->id)->first();

        $measurement = Measurement::create([
            'patient_id' => $patient->id,
            'measurement_date' => $request->measurement_date,
            'Fasting' => $request->Fasting,
            'creator' => $request->creator,
            'random' => $request->random,
        ]);
        return Response::json([
            'code' => 200,
            'message' => 'Diabetes measurement was recorded successfully',
            'data' => $measurement,
        ]);
    }
    public function showMeasurements(Request $request)
    {
        # code...
        $user = $request->user();
        $patient = Patient::with('measurements')->where('user_id', $user->id)->first();

        return Response::json([
            'code' => 200,
            'message' => 'measurements',
            'data' => $patient->measurements
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // PatientController.php

    public function searchDoctors(Request $request)
    {
        $query = $request->input('query');

        $doctors = Doctor::where('name', 'like', '%' . $query . '%')->get();

        return Response::json([
            'code' => 200,
            'message' => 'Doctor search results',
            'data' => $doctors
        ]);
    }
}
