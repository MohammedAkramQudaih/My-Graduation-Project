<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function registerPatient(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email|unique:patients',
            'name' => 'required|string',
            'password' => ['required'],

        ]);
        if ($validator->fails()) {

            return Response::json([
                'code' => 400,
                'message' => 'registration failed',
                'data' => $validator->messages(),
            ]);
        }else{
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'patient'
            ]);
            $user->save();
            $user = User::where('email', $request->email)->first();
            $user_id = $user->getAttribute('id');
            //create the patient row
            $patient = new Patient([
                'name' => $request->name,
                'email' => $request->email,
                'user_id' => $user_id,
            ]);
            $patient->save();
            return Response::json([
                'code' => 200,
                'message' => 'successfully registered patient',
                'data' => $patient,
            ]);
        }
        
    }

/** سأقوم بحذف هذه الدالة فور الا نتهاء من تجهيو الداشبورد registerDoctore
 * لان الطبيب لا يشترك بالتطبيق بنفسه وانما يقوم الادمن بإضافته
*/
    public function registerDoctor(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email|unique:doctors',
            'name' => 'required|string',
            'password' => ['required'],

        ]);
        if ($validator->fails()) {

            return Response::json([
                'code' => 400,
                'message' => 'registration failed',
                'data' => $validator->messages(),
            ]);
        }else{
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'doctor'
            ]);
            $user->save();
            $user = User::where('email', $request->email)->first();
            $user_id = $user->getAttribute('id');
            //create the patient row
            $doctor = new Doctor([
                'name' => $request->name,
                'email' => $request->email,
                'user_id' => $user_id,
            ]);
            $doctor->save();
            return Response::json([
                'code' => 200,
                'message' => 'successfully registered doctor',
                'data' => $doctor,
            ]);
        }
    }
    public function loginPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return Response::json([
                'code' => 400,
                'message' => $validator->errors()->all(),
                'data' => []
            ]);
        }

        $patient = User::where('email', $request->email)->first();
        if (!$patient || !Hash::check($request->password, $patient->password) || $patient->role !== 'patient') {
            return Response::json([
                'code' => 400,
                'message' => 'Invalid Credentials',
                'data' => []
            ]);
        }
        $patientObj = Patient::where('user_id', $patient->id)->first();
        $patientId = $patientObj->id;

        $token = $patient->createToken('mobile', ['role:patient'])->plainTextToken;

        return Response::json([
            'code' => 200,
            'message' => 'logged in successfully',
            'data' => [
                'patient'=> $patient,
                'patient_id' => $patientId,
                'token' => $token,

            ]
        ]);
    }

    public function loginDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return Response::json([
                'code' => 400,
                'message' => $validator->errors()->all(),
                'data' => []
            ]);
        }

        $doctor = User::where('email', $request->email)->first();
        // $doctor = User::where('email', $request->email)->where('role', 'doctor')->first();
        if (!$doctor || !Hash::check($request->password, $doctor->password) || $doctor->role !== 'doctor') {
            return Response::json([
                'code' => 400,
                'message' => 'Invalid Credentials',
                'data' => []
            ]);
        }
        $doctorObj = Doctor::where('user_id', $doctor->id)->first();
        $doctorId = $doctorObj->id;

        $token = $doctor->createToken('mobile', ['role:doctor'])->plainTextToken;

        return Response::json([
            'code' => 200,
            'message' => 'logged in successfully',
            'data' => [
                'doctor'=> $doctor,
                'doctor_id' => $doctorId,
                'token' => $token,

            ]
        ]);
    }

    public function logout(Request $request )
    {
        $user =$request->user();
        $user->tokens()->delete();
        
        return Response::json([
            'code' => 200,
            'message' => 'logged out successfully',
            'data' => []
        ]);
    }



    public function sendResetLinkEmail(Request $request)
    {

        $validatedData = $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($validatedData);

        return response()->json([
            'code' => 200,
            'msg' => "Reset link sent to your email",
            'data' => [],
        ]);
    }


    public function resetPassword(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|',
            'token' => 'required'
        ]);

        // Find the user associated with the email
        $user = User::where('email', $validatedData['email'])->first();
        // return $validatedData['token'];
        // If the user is found and the token is valid
        if ($user && $validatedData['email'] === $user->email) {
            // Update the user's password
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            return response()->json(['message' => 'Password reset successfully'], 200);
        } else {
            return response()->json(['error' => 'Invalid token or email'], 401);
        }
    }

}
