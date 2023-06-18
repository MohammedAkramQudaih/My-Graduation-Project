<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //

    public function profile(Request $request)
    {
        $user = $request->user();
        $doctor = Doctor::with('workHours')->where('user_id', $user->id)->first();
        // return $patient;

        return response()->json([
            'doctor' => $doctor,
        ], 200);
    }
}
